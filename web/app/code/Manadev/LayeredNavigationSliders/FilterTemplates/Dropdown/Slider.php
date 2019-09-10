<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates\Dropdown;

use Manadev\LayeredNavigation\Blocks\FilterRenderer;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigationSliders\FilterTemplates\AbstractSliderFilterTemplate;

class Slider extends AbstractSliderFilterTemplate
{
    public function getTitle() {
        return __('Slider');
    }

    protected function createFilter($name, $attributeId, $appliedRanges) {
        return $this->factory->createLayeredDropdownFilter($name, $attributeId, $appliedRanges);
    }

    protected function createFacet(Filter $filter) {
        $name = $filter->getData('param_name');
        $attributeId = $filter->getData('attribute_id');
        $calculateSliderMinMax = $filter->getData('calculate_slider_min_max_based_on');
        $appliedRanges = $this->getAppliedRange($name);

        return $this->factory->createSliderRangeDropdownFacet($name, $attributeId, $appliedRanges,
            $calculateSliderMinMax, $filter->getData('show_selected_options_first'),
            $filter->getData('sort_options_by'));
    }

    protected function getAppliedRange($name) {
        return $this->requestParser->readMultipleValueInteger($name);
    }

    /**
     * @param string $values
     *
     * @return mixed|bool
     */
    public function getAppliedOptions($values) {
        return $this->requestParser->readMultipleValueIntegerString($values);
    }

    public function isLabelHtmlEscaped() {
        return true;
    }

    public function getScriptConfig($sliderData, Filter $filter, FilterRenderer $block, EngineFilter $engineFilter) {
        $config = [
            'paramName' => $filter->getData('param_name'),
            'appliedFormat' => $this->getAppliedFilterFormat(),
            'applyFilterURL' => $block->getMultiSelectSliderApplyUrl($engineFilter),
            'clearFilterURL' => $block->getRemoveItemUrl($engineFilter),
            'isDropdownInline' => $this->isSliderInlineInDropdown(),
            'isInitLate' => $this->isSliderDisplayed(),
            'showRangeInput' => false,
            'isDropdownSlider' => true,
            'allowedValues' => $sliderData['available_values'],
            'allowedValuesId' => $sliderData['available_values_id'],
            'valueDelimiter' => '_',
        ];

        if ($engineFilter->isApplied()) {
            $config['appliedRange'] = [$sliderData['min_applied_range'], $sliderData['max_applied_range']];
        }

        return $config;
    }

    public function getType() {
        return 'dropdown';
    }
}