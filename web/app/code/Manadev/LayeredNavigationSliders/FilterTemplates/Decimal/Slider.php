<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates\Decimal;

use Manadev\LayeredNavigationSliders\FilterTemplates\AbstractSliderFilterTemplate;

class Slider extends AbstractSliderFilterTemplate
{
    public function getTitle() {
        return __('Slider');
    }

    public function getType() {
        return 'decimal';
    }
}