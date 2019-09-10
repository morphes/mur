<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates\Price;

class RangeInput extends Slider
{
    protected $showRangeInputOnly = true;

    public function getTitle() {
        return __('Range Input');
    }

    public function getAppliedFilterFormat() {
        return __("From __0__ to __1__");
    }
}