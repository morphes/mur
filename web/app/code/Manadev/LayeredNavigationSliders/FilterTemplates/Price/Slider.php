<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates\Price;

use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigationSliders\FilterTemplates\AbstractSliderFilterTemplate;

class Slider extends AbstractSliderFilterTemplate
{
    public function getTitle() {
        return __('Slider');
    }

    /**
     * @param $name
     * @param $attributeId
     * @param $appliedRanges
     * @param $calculateSliderMinMax
     * @param $numberFormat
     *
     * @return mixed
     */
    protected function createFacet(Filter $filter) {
        $name = $filter->getData('param_name');
        $attributeId = $filter->getData('attribute_id');
        $calculateSliderMinMax = $filter->getData('calculate_slider_min_max_based_on');
        $numberFormat = $filter->getData('number_format');
        $showThousandSeparator = $filter->getData('show_thousand_separator');
        $appliedRanges = $this->requestParser->readMultipleValueRange($name);
        $precision = $filter->getData("decimal_digits");

        return $this->factory->createSliderRangePriceFacet($name, $attributeId, $appliedRanges, $calculateSliderMinMax, $numberFormat, $showThousandSeparator, $precision);
    }

    /**
     * @param $name
     * @param $attributeId
     * @param $appliedRanges
     *
     * @return mixed
     */
    protected function createFilter($name, $attributeId, $appliedRanges) {
        return $this->factory->createLayeredPriceFilter($name, $attributeId, $appliedRanges, true);
    }

    public function getType() {
        return 'price';
    }
}