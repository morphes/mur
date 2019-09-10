<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Resources\Facets\Dropdown;

use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\LayeredNavigationSliders\Facets\Dropdown\DropdownSliderRangeFacet;
use Manadev\LayeredNavigationSliders\Resources\Facets\AbstractSliderFacetResource;
use Manadev\LayeredNavigationSliders\Sources\CalculateSliderMinMaxSource;
use Manadev\ProductCollection\Configuration;
use Manadev\ProductCollection\Contracts\Facet;
use Manadev\ProductCollection\FacetSorter;
use Manadev\ProductCollection\Factory;
use Manadev\ProductCollection\Resources\HelperResource;
use Zend_Db_Expr;

class DropdownSliderRangeFacetResource extends AbstractSliderFacetResource
{
    /**
     * @var FacetSorter
     */
    protected $sorter;

    public function __construct(Db\Context $context, Factory $factory, StoreManagerInterface $storeManager,
        Configuration $configuration, HelperResource $helperResource, FacetSorter $sorter,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $factory, $storeManager, $configuration, $helperResource, $resourcePrefix);
        $this->sorter = $sorter;
    }

    protected function _construct() {
        $this->_setMainTable('catalog_product_index_eav');
    }

    /**
     * @param Select $select
     * @param Facet $facet
     * @return mixed
     */
    public function count(Select $select, Facet $facet) {
        /* @var $facet DropdownSliderRangeFacet */
        if (!count($facet->getAvailableValues())) {
            return false;
        }

        // Return array containing the available values, include selected items too.
        $selectedIds = $facet->getSelectedOptionIds();
        $minRange = null;
        $maxRange = count($facet->getAvailableValues()) - 1;
        $x = 0;
        if($selectedIds) {
            foreach($facet->getAvailableValues() as $id => $label) {
                if(in_array($id, $selectedIds)) {
                    if (is_null($minRange)) {
                        $minRange = $x;
                    }
                    $maxRange = $x;
                }
                $x++;
            }
        }

        if(is_null($minRange)) {
            $minRange = 0;
        }

        $available_values = array_values($facet->getAvailableValues());
        $sliderData = [
            'min_applied_range' => $minRange,
            'max_applied_range' => $maxRange,
            'available_values' => $available_values,
            'available_values_id' => array_keys($facet->getAvailableValues()),
            'selected_ids' => $facet->getSelectedOptionIds(),
            'is_selected' => (bool)$selectedIds,
            'sort_order' => 0,
        ];
        $this->formatItem($sliderData, $available_values[$minRange], $available_values[$maxRange], $facet);

        return $sliderData;
    }

    public function prepare(Select $select, Facet $facet) {
        /* @var $facet DropdownSliderRangeFacet */

        // Set the available values for this dropdown in the facet.
        // Depending on calculate slider min/max, filter down the available values.

        $this->helperResource->clearFacetSelect($select);

        $db = $this->getConnection();

        $fields = array(
            'sort_order' => new Zend_Db_Expr("`o`.`sort_order`"),
            'value' => new Zend_Db_Expr("`eav`.`value`"),
            'label' => new Zend_Db_Expr("COALESCE(`vs`.`value`, `vg`.`value`)"),
        );
        if ($facet->getCalculateSliderMinMax() == CalculateSliderMinMaxSource::ALL_PRODUCTS_ON_A_STORE) {
            $parts = $select->getPart("from");
            $joinCondition = $parts['cat_index']['joinCondition'];
            $joinCondition = substr($joinCondition, 0, strpos($joinCondition, " AND cat_index.category_id"));
            $parts['cat_index']['joinCondition'] = $joinCondition;
            $select->setPart("from", $parts);
        }

        $select
            ->joinInner(array('eav' => $this->getTable('catalog_product_index_eav')),
                "`eav`.`entity_id` = `e`.`entity_id` AND
                {$db->quoteInto("`eav`.`attribute_id` = ?", $facet->getAttributeId())} AND
                {$db->quoteInto("`eav`.`store_id` = ?", $this->getStoreId())}",
                null
            )
            ->joinInner(array('o' => $this->getTable('eav_attribute_option')),
                "`o`.`option_id` = `eav`.`value`", null)
            ->joinInner(array('vg' => $this->getTable('eav_attribute_option_value')),
                $db->quoteInto("`vg`.`option_id` = `eav`.`value` AND `vg`.`store_id` = ?", 0), null)
            ->joinLeft(array('vs' => $this->getTable('eav_attribute_option_value')),
                $db->quoteInto("`vs`.`option_id` = `eav`.`value` AND `vs`.`store_id` = ?", $this->getStoreId()), null)
            ->columns(array_merge($fields, [
                'count' => new Zend_Db_Expr("0"),
                'is_selected' => new Zend_Db_Expr("0"),
            ]))
            ->order("sort_order")
            ->group($fields);

        $availableValues = [];
        $items = $db->fetchAll($select);
        $this->sorter->sort($facet, $items);
        foreach($items as $data) {
            $availableValues[$data['value']] = $data['label'];
        }
        $facet->setAvailableValues($availableValues);
    }

    protected function formatItem(&$item, $from, $to, Facet $facet) {
        $this->helperResource->formatDropdownRangeFacet($item, $from, $to);
    }
}