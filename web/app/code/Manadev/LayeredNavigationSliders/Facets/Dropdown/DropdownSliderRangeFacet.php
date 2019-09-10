<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Facets\Dropdown;

use Manadev\ProductCollection\Facets\Dropdown\BaseFacet;

class DropdownSliderRangeFacet extends BaseFacet
{
    protected $availableValues;
    /**
     * @var
     */
    protected $calculateSliderMinMax;

    public function __construct($name, $attributeId, $selectedOptionIds, $calculateSliderMinMax,
        $showSelectedOptionsFirst, $sortBy)
    {
        $this->calculateSliderMinMax = $calculateSliderMinMax;
        parent::__construct($name, $attributeId, $selectedOptionIds, false,
            $showSelectedOptionsFirst, $sortBy);
    }

    public function getType() {
         return 'dropdown_slider_range';
    }

    /**
     * @return mixed
     */
    public function getAvailableValues() {
        return $this->availableValues;
    }

    /**
     * @param array $availableValues
     */
    public function setAvailableValues(array $availableValues) {
        $this->availableValues = $availableValues;
    }

    /**
     * @return mixed
     */
    public function getCalculateSliderMinMax() {
        return $this->calculateSliderMinMax;
    }
}