<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Sources;

use Manadev\Core\Source;

class ApplyFiltersSource extends Source
{
    public function getOptions() {
        return [
            'after_each_click' => __('After Each Click'),
            'after_pressing_apply_button' => __("After Pressing 'Apply' Button"),
        ];
    }
}