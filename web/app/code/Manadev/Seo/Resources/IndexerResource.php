<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Model\ResourceModel\Db;
use Magento\Setup\Model\Installer;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Features;
use Manadev\Core\Helpers\DbHelper;
use Manadev\Core\Helpers\PhpHelper;
use Manadev\Core\QueryLogger;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Registries\UrlKeySubTypes;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;
use Psr\Log\LoggerInterface as Logger;

class IndexerResource extends Db\AbstractDb
{
    protected $usedStoreConfigPaths;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var QueryLogger
     */
    protected $queryLogger;
    /**
     * @var Logger
     */
    protected $logger;
    /**
     * @var TypeListInterface
     */
    protected $cacheTypeList;
    /**
     * @var UrlKeySubTypes
     */
    protected $urlKeySubTypes;
    /**
     * @var ConflictResolverResource
     */
    protected $conflictResolver;
    /**
     * @var IndexerScopeResource
     */
    protected $scopeResource;
    /**
     * @var DbHelper
     */
    protected $dbHelper;
    /**
     * @var Features
     */
    protected $features;
    /**
     * @var PhpHelper
     */
    protected $phpHelper;

    public function __construct(Db\Context $context, StoreManagerInterface $storeManager, Configuration $configuration,
        QueryLogger $queryLogger, Logger $logger, TypeListInterface $cacheTypeList,
        UrlKeySubTypes $urlKeySubTypes, ConflictResolverResource $conflictResolver,
        IndexerScopeResource $scopeResource, DbHelper $dbHelper, Features $features,
        PhpHelper $phpHelper,
        $resourcePrefix = null)
    {
        parent::__construct($context, $resourcePrefix);
        $this->storeManager = $storeManager;
        $this->configuration = $configuration;
        $this->queryLogger = $queryLogger;
        $this->logger = $logger;
        $this->cacheTypeList = $cacheTypeList;
        $this->urlKeySubTypes = $urlKeySubTypes;
        $this->conflictResolver = $conflictResolver;
        $this->scopeResource = $scopeResource;
        $this->dbHelper = $dbHelper;
        $this->features = $features;
        $this->phpHelper = $phpHelper;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('mana_url_key', 'id');
    }

    public function getUsedStoreConfigPaths() {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return [];
        }

        if (!$this->usedStoreConfigPaths) {
            $this->usedStoreConfigPaths = [
                Configuration::SYMBOLS,
            ];

            foreach ($this->urlKeySubTypes->getList() as $subType) {
                $this->usedStoreConfigPaths = array_merge($this->usedStoreConfigPaths, $subType->getIndexer()->getUsedStoreConfigPaths());
            }

            $this->usedStoreConfigPaths = array_flip($this->usedStoreConfigPaths);
        }

        return $this->usedStoreConfigPaths;
    }

    public function reindexAll($useTransaction = true) {
        $this->index(new IndexerScopeData(['all' => true, 'use_transaction' => $useTransaction]));
    }

    public function reindexChangedUrlRewrites($ids, $useTransaction = true) {
        $this->index(new IndexerScopeData(['url_rewrite_ids' => $ids, 'use_transaction' => $useTransaction]));
    }

    public function reindexChangedAttributes($ids, $useTransaction = true) {
        $this->index(new IndexerScopeData(['attribute_ids' => $ids, 'use_transaction' => $useTransaction]));
    }

    public function reindexChangedFilters($ids, $useTransaction = true) {
        $this->index(new IndexerScopeData(['filter_ids' => $ids, 'use_transaction' => $useTransaction]));
    }

    public function reindexChangedOptions($ids, $useTransaction = true) {
        $attributeIds = $this->getAttributeIdsByOptionIds($ids);
        $this->index(new IndexerScopeData(['attribute_ids' => $attributeIds, 'use_transaction' => $useTransaction]));
    }

    public function reindexChangedUrlKeys($ids, $useTransaction = false) {
        $this->index(new IndexerScopeData(['url_key_ids' => $ids, 'use_transaction' => $useTransaction]));
    }

    /**
     * @param IndexerScopeData $scope
     * @throws \Exception
     */
    protected function index($scope) {
        if ($this->phpHelper->isCalledFrom(Installer::class)) {
            return;
        }

        if ($this->configuration->isSeoUrlKeyIndexQueryLoggingEnabled()) {
            $this->queryLogger->begin('seo-url-key-index');
        }
        // Clear config cache if config is not set
        if(is_null($this->configuration->isPresent())) {
            $this->cacheTypeList->cleanType('config');
            throw new \Exception('Manadev_Seo config is not yet set. Please try again.');
        }

        $db = $this->getConnection();

        if ($scope->use_transaction) {
            $db->beginTransaction();
        }

        try {
            foreach($this->storeManager->getStores() as $store) {
                $scope->store_id = $store->getId();

                $this->indexStore($scope);
            }

            if ($scope->use_transaction) {
                $db->commit();
            }
        }
        catch (\Exception $e) {
            $this->logger->critical($e);
            if ($scope->use_transaction) {
                $db->rollBack();
            }

            throw $e;
        }
        finally {
            if ($this->configuration->isSeoUrlKeyIndexQueryLoggingEnabled()) {
                $this->queryLogger->end('seo-url-key-index');
            }
        }
    }

    /**
     * @param IndexerScopeData $scope
     */
    protected function markKeysAsRedirects($scope) {
        $db = $this->getConnection();

        $where = $db->quoteInto("`status` <> ?", UrlKeyStatus::DISABLED);
        $where .= " AND " . $db->quoteInto("`store_id` = ?", $scope->store_id);

        if ($whereClause = $this->scopeResource->limitMarkingKeysAsRedirects($scope)) {
            $where .= " AND ($whereClause)";
        }

        $db->update($this->getMainTable(), [
            'status' => UrlKeyStatus::REDIRECTED
        ], $where);
    }

    /**
     * @param IndexerScopeData $scope
     */
    protected function indexStore($scope) {
        $this->markKeysAsRedirects($scope);

        foreach ($this->urlKeySubTypes->getList() as $subType) {
            $subType->getIndexer()->index($scope);
        }

        $this->resetConflictingUrlKey($scope);
        $this->conflictResolver->resolve($scope);
    }

    protected function resetConflictingUrlKey($scope) {
        $db = $this->getConnection();

        $where = $db->quoteInto("`status` <> ?", UrlKeyStatus::DISABLED);
        $where .= " AND " . $db->quoteInto("`store_id` = ?", $scope->store_id);

        if ($whereClause = $this->scopeResource->limitResettingConflictingUrlKeys($scope)) {
            $where .= " AND ($whereClause)";
        }

        $fields = [];

        $conflictingUrlKey = "COALESCE(`assigned_url_key`, `inferred_url_key`)";
        $notChanged = "`conflicting_url_key` = $conflictingUrlKey";

        $fields['conflict_resolution'] = "IF($notChanged, `conflict_resolution`, NULL)";
        $fields['url_key'] = "IF ($notChanged, `url_key`, $conflictingUrlKey)";
        $fields['conflicting_url_key'] = $conflictingUrlKey;

        $db->update($this->getMainTable(), $this->dbHelper->wrapIntoZendDbExpr($fields), $where);
    }

    public function getUrlRewriteIdsByCategoryId($categoryId) {
        $db = $this->getConnection();

        $path = $db->fetchOne($db->select()
            ->from($this->getTable('catalog_category_entity'), 'path')
            ->where("`entity_id` = ?", $categoryId)
        );

        $categoryIds = $db->fetchCol($db->select()
            ->from($this->getTable('catalog_category_entity'), 'entity_id')
            ->where("`path` LIKE ?", "$path%")
        );

        return $db->fetchCol($db->select()
            ->from($this->getTable('url_rewrite'), 'url_rewrite_id')
            ->where("`entity_id` IN (?)", $categoryIds)
            ->where("`entity_type` = ?", 'category')
        );
    }

    public function getUrlRewriteIdsByCmsPageId($pageId) {
        $db = $this->getConnection();

        return $db->fetchCol($db->select()
            ->from($this->getTable('url_rewrite'), 'url_rewrite_id')
            ->where("`entity_id` = ?", $pageId)
            ->where("`entity_type` = ?", 'cms-page')
        );
    }

    public function getAttributeIdsByOptionIds($ids) {
        $db = $this->getConnection();

        return $db->fetchCol($db->select()
            ->distinct()
            ->from($this->getTable('eav_attribute_option'), 'attribute_id')
            ->where("`option_id` IN (?)", $ids)
        );
    }
}