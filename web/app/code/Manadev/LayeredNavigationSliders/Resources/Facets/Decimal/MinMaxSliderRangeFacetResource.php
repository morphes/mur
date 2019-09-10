<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Resources\Facets\Decimal;

use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\LayeredNavigation\Helper;
use Manadev\LayeredNavigationSliders\Facets\Decimal\AbstractSliderFacet;
use Manadev\LayeredNavigationSliders\Facets\Decimal\MinMaxSliderRangeFacet;
use Manadev\LayeredNavigationSliders\Resources\Facets\AbstractSliderFacetResource;
use Manadev\LayeredNavigationSliders\Sources\CalculateSliderMinMaxSource;
use Manadev\ProductCollection\Configuration;
use Manadev\ProductCollection\Contracts\Facet;
use Manadev\ProductCollection\Factory;
use Manadev\ProductCollection\Resources\HelperResource;

class MinMaxSliderRangeFacetResource extends AbstractSliderFacetResource
{
    protected $_maxFilter;
    /**
     * @var Helper
     */
    protected $layeredNavHelper;

    public function __construct(
        Db\Context $context, Factory $factory, StoreManagerInterface $storeManager, Configuration $configuration,
        HelperResource $helperResource, Helper $layeredNavHelper, $resourcePrefix = null
    ) {
        $this->layeredNavHelper = $layeredNavHelper;
        parent::__construct($context, $factory, $storeManager, $configuration, $helperResource, $resourcePrefix);
    }

    protected function _construct() {
        $this->_setMainTable('catalog_product_index_eav_decimal');
    }

    protected function formatItem(&$item, $from, $to, Facet $facet) {
        /** @var AbstractSliderFacet $facet */
        $this->helperResource->formatCustomRangeFacet($item, $from, $to, $facet->getNumberFormat(), $facet->isShowThousandSeparator());
    }

    public function count(Select $select, Facet $facet) {
        /** @var MinMaxSliderRangeFacet $facet */
        $maxFilter = $this->_getMaxFilter($facet);
        if($facet->getMinMaxRole() == "max" || !$maxFilter || !count($facet->getAvailableValues())) {
            return false;
        }

        return parent::count($select, $facet);
    }

    public function prepare(Select $select, Facet $facet) {
        /* @var $facet MinMaxSliderRangeFacet */

        if($facet->getCalculateSliderMinMax() == CalculateSliderMinMaxSource::ALL_PRODUCTS_ON_A_STORE) {
            $parts = $select->getPart("from");
            $joinCondition = $parts['cat_index']['joinCondition'];
            $joinCondition = substr($joinCondition, 0, strpos($joinCondition, " AND cat_index.category_id"));
            $parts['cat_index']['joinCondition'] = $joinCondition;
            $select->setPart("from", $parts);
        }

        $db = $this->getConnection();

        $maxAttributeSelect = clone $select;
        $maxFilter = $this->_getMaxFilter($facet);

        if(!$maxFilter) {
            return;
        }

        $available_values = array_unique($db->fetchCol($this->availableValuesSelect($select, $facet)));
        sort($available_values, SORT_NUMERIC);
        $stats = $db->fetchRow($this->statSelect($select, $facet));

        $maxAttributeId = $maxFilter->getData('attribute_id');

        $max_available_values = array_unique($db->fetchCol($this->availableValuesSelectByAttrId($maxAttributeSelect, $maxAttributeId)));
        sort($max_available_values, SORT_NUMERIC);
        $maxStats = $db->fetchRow($this->statSelectByAttrId($maxAttributeSelect, $maxAttributeId, $facet->getPrecision()));

        $min = min($stats['min'], $maxStats['min']);
        $max = max($stats['max'], $maxStats['max']);
        $available_values = array_unique(array_merge($available_values, $max_available_values));

        if($stats['count'] > 1 && $maxStats['count'] > 1) {
            $facet->setMinRange($min);
            $facet->setMaxRange($max);
            $facet->setAvailableValues($available_values);
        }
    }

    /**
     * @param Facet $facet
     *
     * @return mixed
     */
    protected function _getMaxFilter(Facet $facet) {
        /** @var MinMaxSliderRangeFacet $facet */
        if(!$this->_maxFilter && $facet->getMaxFilterId()) {
            $filters = $this->layeredNavHelper->getAllFilters();
            $this->_maxFilter = $filters->getItemById($facet->getMaxFilterId());
        }

        return $this->_maxFilter;
    }
}