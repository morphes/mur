<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Registries;

class SliderStyles {
    /**
     * @var FilterType[]
     */
    protected $sliderStyles;

    public function __construct(array $sliderStyles)
    {
        $this->sliderStyles = $sliderStyles;
    }

    /**
     * @param $type
     * @return bool|FilterType
     */
    public function get($type) {
        return isset($this->sliderStyles[$type]) ? $this->sliderStyles[$type] : false;
    }

    public function getList() {
        return $this->sliderStyles;
    }
}