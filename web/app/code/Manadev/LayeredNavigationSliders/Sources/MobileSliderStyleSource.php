<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Sources;

use Manadev\Core\Source;
use Manadev\LayeredNavigationSliders\Registries\MobileSliderStyles;

class MobileSliderStyleSource extends Source
{
    /**
     * @var MobileSliderStyles
     */
    protected $mobileSliderStyles;

    public function __construct(MobileSliderStyles $mobileSliderStyles) {
        $this->mobileSliderStyles = $mobileSliderStyles;
    }

    public function getOptions() {
        return $this->mobileSliderStyles->getList();
    }
}