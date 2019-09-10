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

class OptimizedOptionFacetResource
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
     * @param $facet
     * @return array
     */
    public function aroundGetFields($resource, callable $proceed, $facet) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($facet);
        }

        return array_merge($proceed($facet), [
            'url_key' => new \Zend_Db_Expr("`url_key`.`url_key`"),
            'url_position' => new \Zend_Db_Expr("`url_key`.`position`"),
        ]);
    }

    /**
     * @param Db\AbstractDb $resource
     * @param callable $proceed
     * @param Select $select
     * @param $facet
     */
    public function aroundAddJoins($resource, callable $proceed, Select $select, $facet) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($select, $facet);
        }

        $db = $resource->getConnection();
        $storeId = $this->storeManager->getStore()->getId();

        $proceed($select, $facet);

        $select->joinLeft(['url_key' => $resource->getTable('mana_url_key')],
            "`url_key`.`option_id` = `eav`.`value` AND " .
            $db->quoteInto("`url_key`.`sub_type` = ?", UrlKeySubTypeEnum::FILTER_OPTION) . " AND " .
            $db->quoteInto("`url_key`.`status` = ?", UrlKeyStatus::ACTIVE) . " AND " .
            $db->quoteInto("`url_key`.`store_id` = ?", $storeId), null);
    }
}