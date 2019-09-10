<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Sources;

use Magento\Framework\Option\ArrayInterface;

class WholeBlockBehaviorSource implements ArrayInterface
{
    public function toOptionArray() {
        $result = [
            ['value' => 'collapse', 'label' => __("Initially Collapsed")],
            ['value' => 'expanded', 'label' => __("Initially Expanded")],
        ];

        return $result;
    }
}