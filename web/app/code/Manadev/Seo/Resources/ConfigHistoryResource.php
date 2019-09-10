<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources;

use Magento\Framework\Model\ResourceModel\Db;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Exceptions\NotSupported;
use Manadev\Seo\Data\ConfigHistoryData;

class ConfigHistoryResource extends Db\AbstractDb
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(Db\Context $context, StoreManagerInterface $storeManager, $connectionName = null) {
        parent::__construct($context, $connectionName);
        $this->storeManager = $storeManager;
    }
    /**
     * @param ConfigHistoryData $data
     */
    public function saveOne($data) {
        $db = $this->getConnection();

        $values = $db->fetchCol($db->select()
            ->from(['ch' => $this->getMainTable()], 'value')
            ->where("`ch`.`scope` = ?", $data->scope)
            ->where("`ch`.`scope_id` = ?", $data->scope_id)
            ->where("`ch`.`path` = ?", $data->path)
        );

        if (in_array($data->value, $values)) {
            return;
        }

        $db->insert($this->getMainTable(), (array) $data);
    }

    public function getByScopeAndPath($scope, $scopeId, $path) {
        $db = $this->getConnection();

        $condition = $this->getConditionRecursively('ch', $scope, $scopeId);
        $select = $db->select()
            ->from(['ch' => $this->getMainTable()])
            ->where($condition)
            ->where("`ch`.`path` = ?", $path);

        return array_map(function ($data) {
            return new ConfigHistoryData($data);
        }, $db->fetchAll($select));
    }

    public function deleteById($ids) {
        $db = $this->getConnection();

        $db->delete($this->getMainTable(), $db->quoteInto("`id` IN (?)", $ids));
    }

    /**
     * @param $scope
     * @param $scopeId
     * @return ConfigHistoryData[]
     */
    public function getByScope($scope, $scopeId) {
        $db = $this->getConnection();

        $condition = $this->getConditionRecursively('ch', $scope, $scopeId);
        $select = $db->select()
            ->from(['ch' => $this->getMainTable()], ['path', 'value'])
            ->where($condition);

        return array_map(function ($data) {
            return new ConfigHistoryData($data);
        }, $db->fetchAll($select));
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('mana_config_history', 'id');
    }

    protected function getConditionRecursively($alias, $scope, $scopeId) {
        switch ($scope) {
            case 'stores':
                return $this->getStoreConditionRecursively($alias, $scopeId);
            case 'websites':
                return $this->getWebsiteConditionRecursively($alias, $scopeId);
            case 'default':
                return $this->getGlobalConditionRecursively($alias);
            default:
                throw new NotSupported();
        }
    }

    protected function getGlobalConditionRecursively($alias) {
        return "`$alias`.`scope` = 'default'";
    }

    protected function getWebsiteConditionRecursively($alias, $scopeId) {
        return "`$alias`.`scope` = 'websites' AND `$alias`.`scope_id` = $scopeId OR " .
            $this->getGlobalConditionRecursively($alias);
    }

    protected function getStoreConditionRecursively($alias, $scopeId) {
        return "`$alias`.`scope` = 'stores' AND `$alias`.`scope_id` = $scopeId OR " .
            $this->getWebsiteConditionRecursively($alias, $this->storeManager->getStore($scopeId)->getWebsiteId());
    }

}