<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates\Decimal;

use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigationSliders\FilterTemplates\AbstractSliderFilterTemplate;
use Manadev\ProductCollection\Contracts\ProductCollection;
use Manadev\ProductCollection\Query;

class MinMaxSlider extends AbstractSliderFilterTemplate
{

    public function getTitle() {
        return __('Min/Max Slider');
    }

    protected function createFacet(Filter $filter) {
        $name = $filter->getData('param_name');
        $attributeId = $filter->getData('attribute_id');
        $calculateSliderMinMax = $filter->getData('calculate_slider_min_max_based_on');
        $numberFormat = $filter->getData('number_format');
        $showThousandSeparator = $filter->getData('show_thousand_separator');
        $minMaxRole = $filter->getData('min_max_role');
        $minAttributeCode = $filter->getData('min_slider_code');
        $appliedRanges = $this->requestParser->readMultipleValueRange($name);
        $maxFilterId = $filter->getData('_max_filter_id');
        $precision = $filter->getData("decimal_digits");

        return $this->factory->createSliderMinMaxDecimalFacet($name, $attributeId, $appliedRanges, $calculateSliderMinMax, $numberFormat, $showThousandSeparator, $minMaxRole, $minAttributeCode, $precision, $maxFilterId);
    }

    public function prepare(ProductCollection $productCollection, Filter $filter) {
        $name = $filter->getData('param_name');
        /** @var Query $query */
        $query = $productCollection->getQuery();

        /** @var Filter $maxFilter */
        $maxFilter = $this->_getMaxFilter($filter);

        $maxFilterId = $maxFilter->getId();
        $filter->setData('_max_filter_id', $maxFilterId);

        if (($appliedRanges = $this->requestParser->readMultipleValueRange($name)) !== false && $maxFilterId) {
            $query->getFilterGroup('layered_nav')->addOperand(
                $this->factory->createLayeredMinMaxFilter($name, $filter->getData('attribute_id'),
                    $maxFilter->getData('attribute_id'),$appliedRanges,true));
        }

        $query->addFacet($this->createFacet($filter));
    }

    /**
     * @param Filter $filter
     *
     * @return \Magento\Framework\DataObject
     */
    protected function _getMaxFilter(Filter $filter) {
        $filterCollection = clone $this->layeredNavHelper->getAllFilters();
        $filterCollection->clear();
        $filterCollection
            ->addFieldToFilter('min_slider_code', ['eq' => $filter->getData('attribute_code')])
            ->addFieldToFilter('template', ['eq' => "min_max_slider"])
            ->addFieldToFilter("min_max_role", ['eq' => "max"]);
        return $filterCollection->getFirstItem();
    }

    public function getType() {
        return 'decimal';
    }
}