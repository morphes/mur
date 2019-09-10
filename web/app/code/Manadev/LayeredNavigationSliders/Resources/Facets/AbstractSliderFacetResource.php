<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Resources\Facets;

use Magento\Framework\DB\Select;
use Manadev\LayeredNavigationSliders\Facets\Decimal\AbstractSliderFacet;
use Manadev\LayeredNavigationSliders\Sources\CalculateSliderMinMaxSource;
use Manadev\ProductCollection\Contracts\Facet;
use Manadev\ProductCollection\Contracts\FacetResource;
use Manadev\ProductCollection\Contracts\Filter;
use Zend_Db_Expr;

abstract class AbstractSliderFacetResource extends FacetResource
{
    abstract protected function formatItem(&$item, $from, $to, Facet $facet);

    public function getFilterCallback(Facet $facet) {
        return $this->helperResource->dontApplyFilterNamed($facet->getName());
    }

    public function count(Select $select, Facet $facet) {
        /* @var $facet AbstractSliderFacet */
        if(is_null($facet->getMaxRange())) {
            return false;
        }
        $sliderData = [
            'is_selected' => false,
            'sort_order' => 0
        ];
        $appliedRanges = $facet->getAppliedRanges();

        if($appliedRanges) {
            $from = $appliedRanges[0][0];
            $to = $appliedRanges[0][1];
            $this->formatItem($sliderData, $from, $to, $facet);
            $sliderData['is_selected'] = true;
        }

        $sliderData = array_merge($sliderData, [
            'min_range' => $facet->getMinRange(),
            'max_range' => $facet->getMaxRange(),
            'available_values' => $facet->getAvailableValues(),
        ]);

        return $sliderData;
    }

    public function isPreparationStepNeeded() {
        return true;
    }

    public function getPreparationFilterCallback(Facet $facet) {
        /** @var $facet AbstractSliderFacet */
        switch($facet->getCalculateSliderMinMax()) {
            case CalculateSliderMinMaxSource::FILTERED_PRODUCTS_ON_A_PAGE :
                // Apply everything except the slider filter in layered navigation.
                return function (Filter $filter) use($facet) {
                    return $filter->getName() != $facet->getName();
                };
                break;
            case CalculateSliderMinMaxSource::ALL_PRODUCTS_ON_A_PAGE :
            case CalculateSliderMinMaxSource::ALL_PRODUCTS_ON_A_STORE :
            default:
        }

        return $this->helperResource->dontApplyLayeredNavigationFilters();
    }

    public function prepare(Select $select, Facet $facet) {
        /* @var $facet AbstractSliderFacet */

        if($facet->getCalculateSliderMinMax() == CalculateSliderMinMaxSource::ALL_PRODUCTS_ON_A_STORE) {
            $parts = $select->getPart("from");
            $joinCondition = $parts['cat_index']['joinCondition'];
            $joinCondition = substr($joinCondition, 0, strpos($joinCondition, " AND cat_index.category_id"));
            $parts['cat_index']['joinCondition'] = $joinCondition;
            $select->setPart("from", $parts);
        }

        $db = $this->getConnection();
        $available_values = array_unique($db->fetchCol($this->availableValuesSelect($select, $facet)));
        sort($available_values, SORT_NUMERIC);
        $stats = $db->fetchRow($this->statSelect($select, $facet));
//        if($facet->getName() == 'rfm_bluetooth') {
//            die(var_dump($stats));
//        }
        if($stats['count'] > 1 && $stats['max'] > $stats['min']) {
            $facet->setMinRange($stats['min']);
            $facet->setMaxRange($stats['max']);
            $facet->setAvailableValues($available_values);
        }
    }
    protected function availableValuesSelect(Select $select, Facet $facet) {
        /** @var AbstractSliderFacet $facet */
        return $this->availableValuesSelectByAttrId($select, $facet->getAttributeId());
    }

    protected function statSelect(Select $select, Facet $facet) {
        /** @var AbstractSliderFacet $facet */
        return $this->statSelectByAttrId($select, $facet->getAttributeId(), $facet->getPrecision());
    }

    protected function expr(Select $select, Facet $facet) {
        /** @var AbstractSliderFacet $facet */
        return $this->exprByAttrId($select, $facet->getAttributeId());
    }

    protected function exprByAttrId(Select $select, $attributeId){
        return $this->helperResource->getEavExpr($select, $this->getMainTable(), $attributeId);
    }

    protected function statSelectByAttrId(Select $select, $attributeId, $precision) {
        $this->helperResource->clearFacetSelect($select);

        $multiplier = pow(10, $precision);
        $select->columns([
            'min' => new Zend_Db_Expr("FLOOR(MIN({$this->exprByAttrId($select, $attributeId)}) * $multiplier) / $multiplier"),
            'max' => new Zend_Db_Expr("CEIL(MAX({$this->exprByAttrId($select, $attributeId)}) * $multiplier) / $multiplier"),
            'count' => new Zend_Db_Expr("COUNT(*)"),
        ]);

        return $select;
    }

    protected function availableValuesSelectByAttrId(Select $select, $attributeId) {
        $this->helperResource->clearFacetSelect($select);

        $select->columns(
            [
                'available_values' => new Zend_Db_Expr("{$this->exprByAttrId($select, $attributeId)}"),
            ]
        );

        return $select;
    }
}