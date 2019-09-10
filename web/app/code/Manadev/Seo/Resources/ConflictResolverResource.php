<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources;

use Manadev\Core\Helpers\DbHelper;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\ConflictScopeData;
use Manadev\Seo\Data\IndexerScopeData;
use Magento\Framework\Model\ResourceModel\Db;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Registries\UrlKeySubTypes;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;

class ConflictResolverResource extends Db\AbstractDb
{
    /**
     * @var ConflictScopeData[]
     */
    protected $conflictScopes = [];

    protected $delimiters = [];

    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var IndexerScopeResource
     */
    protected $indexerScopeResource;
    /**
     * @var UrlKeySubTypes
     */
    protected $urlKeySubTypes;

    /**
     * @var DbHelper
     */
    protected $dbHelper;

    public function __construct(Db\Context $context, Configuration $configuration,
        IndexerScopeResource $indexerScopeResource, UrlKeySubTypes $urlKeySubTypes,
        DbHelper $dbHelper, $connectionName = null)
    {
        parent::__construct($context, $connectionName);

        $this->configuration = $configuration;
        $this->indexerScopeResource = $indexerScopeResource;
        $this->urlKeySubTypes = $urlKeySubTypes;
        $this->dbHelper = $dbHelper;
    }

    protected function _construct() {
        $this->_setMainTable('mana_url_key', 'id');
    }

    /**
     * @param IndexerScopeData $scope
     */
    public function resolve($scope) {
        $this->indexScopes($scope);
        $this->indexDelimiters($scope);

        foreach ($this->conflictScopes as $conflictScope) {
            $this->resolveScope($scope, $conflictScope);
        }
    }

    /**
     * @param IndexerScopeData $scope
     */
    protected function indexScopes($scope) {
        $this->conflictScopes = [];

        foreach ($this->urlKeySubTypes->getList() as $subType) {
            foreach ($subType->getConflictScopes($scope->store_id) as $scopeName => $conflictScope) {
                if (!isset($this->conflictScopes[$scopeName])) {
                    $this->conflictScopes[$scopeName] = $conflictScope;
                    $conflictScope->name = $scopeName;
                }
                else {
                    $this->conflictScopes[$scopeName]->condition .= " OR " . $conflictScope->condition;
                }
            }
        }

        uasort($this->conflictScopes, function($a, $b) {
            if ($a->sort_order < $b->sort_order) return -1;
            if ($a->sort_order > $b->sort_order) return 1;
            return 0;
        });
    }

    /**
     * @param IndexerScopeData $scope
     */
    protected function indexDelimiters($scope) {
        $getters = [
            'getPrefixDelimiter',
            'getSuffixDelimiter',

            'getPrefixParameterDelimiter',
            'getPrefixValueDelimiter',
            'getPrefixOptionDelimiter',

            'getSuffixParameterDelimiter',
            'getSuffixValueDelimiter',
            'getSuffixOptionDelimiter',
        ];

        $delimiters = [];

        foreach ($getters as $getter) {
            $delimiter = $this->configuration->$getter($scope->store_id);
            $delimiters[$delimiter] = $delimiter;

            // TODO: continue here
//            $history = $this->configuration->{$getter . 'History'}($scope->store_id);
//            $delimiters = array_merge($history, array_map(function($delimiter) {
//                return [$delimiter, $delimiter];
//            }, $history));
        }

        $this->delimiters = $delimiters;
    }

    /**
     * @param IndexerScopeData $scope
     * @param ConflictScopeData $conflictScope
     */
    protected function resolveScope($scope, $conflictScope) {
        $db = $this->getConnection();

        $select = $db->select()
            ->from($this->getMainTable())
            ->where($conflictScope->condition)
            ->where("`store_id` = ?", $scope->store_id)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE)
            ->order("url_key ASC");

        if ($where = $this->indexerScopeResource->limitConflictResolution($scope)) {
            $select->where($where);
        }

        /* @var UrlKeyData $conflict */
        $conflict = null;

        foreach ($this->dbHelper->fetchAllPaged($db, $select) as $data) {
            $current = new UrlKeyData($data);

            if ($scope->all) {
                if (!$conflict) {
                    $conflict = $current;
                    continue;
                }

                if ($conflict->url_key != $current->url_key) {
                    $conflict = $current;
                    continue;
                }
            }
            else {
                if (!$this->findSameUrlKey($scope, $current, $conflictScope)) {
                    continue;
                }
            }

            $this->assignConflictResolution($scope, $current, $conflictScope);
        }
    }

    /**
     * @param IndexerScopeData $scope
     * @param UrlKeyData $key
     * @param ConflictScopeData $conflictScope
     */
    protected function assignConflictResolution($scope, $key, $conflictScope) {
        $db = $this->getConnection();

        $resolution = $db->fetchOne($db->select()
            ->from($this->getTable('mana_url_key_conflict_resolution'), 'last_used_resolution')
            ->where("`scope` = ?", $conflictScope->name)
            ->where("`store_id` = ?", $scope->store_id)
            ->where("`url_key` = ?", $key->conflicting_url_key)
        );

        $fields = (array)$key;

        do {
            if (is_numeric($key->conflicting_url_key)) {
                $resolution = $this->generateNumericConflictResolution($resolution);
            }
            else {
                $resolution = $this->generateStringConflictResolution($resolution);
            }

            $key->conflict_resolution = $resolution;
            $key->url_key = $key->conflicting_url_key . '-' . $key->conflict_resolution;

        } while ($this->findSameUrlKey($scope, $key, $conflictScope));

        $db->query($this->dbHelper->insert($db, $this->getTable('mana_url_key_conflict_resolution'),
            $this->dbHelper->wrapIntoZendDbExpr([
                'scope' => "'{$conflictScope->name}'",
                'store_id' => $scope->store_id,
                'url_key' => "'{$key->conflicting_url_key}'",
                'last_used_resolution' => "'$resolution'",
            ])));

        unset($fields['id']);
        $fields['status'] = UrlKeyStatus::REDIRECTED;
        $fields['original_url_key'] = $fields['conflicting_url_key'];
        $db->query($this->dbHelper->insert($db, $this->getMainTable(), $fields));

        $db->update($this->getMainTable(), [
            'conflict_resolution' => $key->conflict_resolution,
            'url_key' => $key->url_key,
        ], $db->quoteInto("id = ?", $key->id));
    }

    /**
     * @param string $resolution
     * @return string
     */
    protected function generateNumericConflictResolution($resolution) {
        static $resolutionSymbols = 'abcdefghijklmnopqrstuvwxyz';
        static $numericSymbols = '0123456789abcdefghijklmnop';

        if (!$resolution) {
            return substr($resolutionSymbols, 0, 1);
        }

        $number26base = strtr($resolution, $resolutionSymbols, $numericSymbols);

        $number = intval($number26base, 26);

        $number++;

        $number26base = base_convert(strval($number), 10, 26);

        return strtr($number26base, $numericSymbols, $resolutionSymbols);
    }

    /**
     * @param string $resolution
     * @return string|int
     */
    protected function generateStringConflictResolution($resolution) {
        return $resolution ? intval($resolution) + 1 : 2;
    }

    /**
     * @param IndexerScopeData $scope
     * @param UrlKeyData $key
     * @param ConflictScopeData $conflictScope
     * @return UrlKeyData|null
     */
    protected function findSameUrlKey($scope, $key, $conflictScope) {
        $db = $this->getConnection();

        $data = $db->fetchRow($db->select()
            ->from($this->getMainTable())
            ->where("`url_key` = ?", $key->url_key)
            ->where("`id` <> ?", $key->id)
            ->where($conflictScope->condition)
            ->where("`store_id` = ?", $scope->store_id)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE)
            ->order("url_key ASC")
            ->limit(1)
       );

        return $data ? new UrlKeyData($data) : null;
    }
}