<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Sources;

use Manadev\Core\Source;

class MinMaxRoleSource extends Source
{

    public function getOptions() {
        return [
            'min' => __("Minimum Value"),
            'max' => __("Maximum Value")
        ];
    }
}