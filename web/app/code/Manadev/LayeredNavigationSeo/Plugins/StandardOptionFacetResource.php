<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Features;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType as UrlKeySubTypeEnum;

class StandardOptionFacetResource
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(StoreManagerInterface $storeManager, Features $features) {
        $this->storeManager = $storeManager;
        $this->features = $features;
    }

    /**
     * @param Db\AbstractDb $resource
     * @param callable $proceed
     * @param array $options
     * @return array
     */
    public function aroundGetAdditionalData($resource, callable $proceed, $options) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($options);
        }

        if (!count($options)) {
            return [];
        }

        $db = $resource->getConnection();

        $select = $db->select()
            ->from(['url_key' => $resource->getTable('mana_url_key')], [
                'value' => new \Zend_Db_Expr("`url_key`.`option_id`"),
                'url_key' => new \Zend_Db_Expr("`url_key`.`url_key`"),
                'url_position' => new \Zend_Db_Expr("`url_key`.`position`"),
            ])
            ->where("`url_key`.`option_id` IN (?)", array_filter(array_map(function($option) {
                return $option['value'];
            }, $options)))
            ->where("`url_key`.`sub_type` = ?", UrlKeySubTypeEnum::FILTER_OPTION)
            ->where("`url_key`.`status` = ?", UrlKeyStatus::ACTIVE)
            ->where("`url_key`.`store_id` = ?", $this->storeManager->getStore()->getId());

        return $db->fetchAssoc($select);
    }
}