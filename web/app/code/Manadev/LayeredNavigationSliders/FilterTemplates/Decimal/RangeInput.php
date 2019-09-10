<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates\Decimal;

use Manadev\LayeredNavigationSliders\FilterTemplates\AbstractSliderFilterTemplate;

class RangeInput extends AbstractSliderFilterTemplate
{
    protected $showRangeInputOnly = true;

    public function getTitle() {
        return __('Range Input');
    }

    public function getAppliedFilterFormat() {
        return __("From __0__ to __1__");
    }

    public function getType() {
        return 'decimal';
    }
}