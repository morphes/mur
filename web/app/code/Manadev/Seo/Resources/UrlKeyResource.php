<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources;

use Magento\Framework\Model\ResourceModel\Db;
use Manadev\Core\Helpers\DbHelper;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeyType;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;

class UrlKeyResource extends Db\AbstractDb
{
    /**
     * @var DbHelper
     */
    protected $dbHelper;
    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    protected $pageUrlKeys = [];

    public function __construct(Db\Context $context, DbHelper $dbHelper, EventManagerInterface $eventManager,
        $connectionName = null)
    {
        parent::__construct($context, $connectionName);
        $this->dbHelper = $dbHelper;
        $this->eventManager = $eventManager;
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('mana_url_key', 'id');
    }

    /**
     * @param string[] $urlKeys
     * @param $storeId
     * @return array
     */
    public function find($urlKeys, $storeId) {
        $db = $this->getConnection();

        $select = $db->select()
            ->from($this->getMainTable())
            ->where("`store_id` = ?", $storeId)
            ->where("url_key IN (?)", $urlKeys)
            ->where("status IN (?)", [UrlKeyStatus::ACTIVE, UrlKeyStatus::REDIRECTED]);

        return $db->fetchAll($select);
    }

    /**
     * @param array $pageCondition
     * @param int $storeId
     * @return string
     */
    public function findPage($pageCondition, $storeId) {
        $key = $storeId . '-' . json_encode($pageCondition);
        if (!isset($this->pageUrlKeys[$key])) {
            $this->pageUrlKeys[$key] = $this->doFindPage($pageCondition, $storeId);
        }
        return $this->pageUrlKeys[$key];
    }

    /**
     * @param array $pageCondition
     * @param int $storeId
     * @return string
     */
    protected function doFindPage($pageCondition, $storeId) {
        $db = $this->getConnection();

        $select = $db->select()
            ->from($this->getMainTable(), 'url_key')
            ->where("`store_id` = ?", $storeId)
            ->where("`type` = ?", UrlKeyType::PAGE)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE);

        foreach ($pageCondition as $criteria => $value) {
            $select->where($criteria, $value);
        }

        return $db->fetchOne($select);
    }

    public function findParameters($storeId) {
        $db = $this->getConnection();

        $select = $db->select()
            ->from($this->getMainTable(), [
                'url_key',
                'sub_type',
                'param_name',
                'url_part',
                'requires_param_name',
                'position',
                'id',
            ])
            ->where("`store_id` = ?", $storeId)
            ->where("`type` = ?", UrlKeyType::PARAMETER)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE);

        return $db->fetchAll($select);
    }


    public function findOptions($optionIds, $storeId) {
        $db = $this->getConnection();

        $select = $db->select()
            ->from($this->getMainTable(), [
                'option_id',
                'url_key',
                'position',
            ])
            ->where("`store_id` = ?", $storeId)
            ->where("`type` = ?", UrlKeyType::OPTION)
            ->where("`option_id` IN (?)", $optionIds)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE);

        return $db->fetchAssoc($select);
    }

    public function findCategory($categoryIds, $storeId) {
        $db = $this->getConnection();

        $select = $db->select()
            ->from($this->getMainTable(), [
                'url_key',
                'position',
            ])
            ->where("`store_id` = ?", $storeId)
            ->where("`type` = ?", UrlKeyType::OPTION)
            ->where("`category_id` IN (?)", $categoryIds)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE);

        return $db->fetchAll($select);
    }

    public function edit($id, $data) {
        $db = $this->getConnection();
        $assignedKey = $this->getAssignedKey($data);
        $ids = [$id];

        $urlKey = $db->fetchRow($db->select()->from($this->getMainTable())->where("`id` = ?", $id));

        if ($assignedKey !== null && $assignedKey != $urlKey['inferred_url_key']) {
            $ids[] = $this->createRedirectToEditedUrlKey($urlKey);
        }

        $db->update($this->getMainTable(), ['assigned_url_key' => $assignedKey], $db->quoteInto("`id` = ?", $id));

        $this->eventManager->dispatch('after_mana_url_key_edit', compact('ids'));

        $this->deleteRedirectWithSameUrlKeyAs($urlKey);
    }

    protected function getAssignedKey($data) {
        $result = empty($data['assigned_url_key'])
            ? null
            : preg_replace("/\\s/", '', $data['assigned_url_key']);


        return $result === '' ? null : $result;
    }

    /**
     * @param array $urlKey
     * @return int
     */
    protected function createRedirectToEditedUrlKey($urlKey) {
        $db = $this->getConnection();

        unset($urlKey['id']);
        $urlKey['status'] = UrlKeyStatus::REDIRECTED;
        $urlKey['original_url_key'] = $urlKey['conflicting_url_key'];
        $db->query($this->dbHelper->insert($db, $this->getMainTable(), $urlKey));

        return $db->fetchOne($db->select()
            ->from($this->getMainTable(), 'id')
            ->where("`type` = ?", $urlKey['type'])
            ->where("`sub_type` = ?", $urlKey['sub_type'])
            ->where("`store_id` = ?", $urlKey['store_id'])
            ->where("`unique_key` = ?", $urlKey['unique_key'])
            ->where("`original_url_key` = ?", $urlKey['original_url_key']
        ));
    }

    protected function deleteRedirectWithSameUrlKeyAs($urlKey) {
        $db = $this->getConnection();

        $ids = $db->fetchCol($select = $db->select()
            ->from(['r' => $this->getMainTable()], 'id')
            ->joinLeft(['a' => $this->getMainTable()], "`a`.`store_id` = `r`.`store_id` AND " .
                "`a`.`reference` = `r`.`reference` AND " .
                $db->quoteInto("`a`.`status` = ?", UrlKeyStatus::ACTIVE), null)
            ->joinLeft(['k' => $this->getMainTable()], $db->quoteInto("`k`.`id` = ?", $urlKey['id']), null)
            ->where("`r`.`store_id` = ?", $urlKey['store_id'])
            ->where("`r`.`reference` = ?", $urlKey['reference'])
            ->where("`r`.`status` = ?", UrlKeyStatus::REDIRECTED)
            ->where("`r`.`url_key` = `a`.`url_key` OR " .
                "`r`.`url_key` = `k`.`url_key` AND `r`.`id` <> `k`.`id`")
//            ->where("`r`.`url_key` = `a`.`url_key`")
        );

        if (!empty($ids)) {
            $db->delete($this->getMainTable(), $db->quoteInto("`id` IN (?)", $ids));
        }
    }
}