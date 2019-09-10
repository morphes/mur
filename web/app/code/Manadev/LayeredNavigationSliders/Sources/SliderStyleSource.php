<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Sources;

use Manadev\Core\Source;
use Manadev\LayeredNavigationSliders\Registries\SliderStyles;

class SliderStyleSource extends Source
{
    /**
     * @var SliderStyles
     */
    protected $sliderStyles;

    public function __construct(SliderStyles $sliderStyles) {
        $this->sliderStyles = $sliderStyles;
    }

    public function getOptions() {
        return $this->sliderStyles->getList();
    }
}