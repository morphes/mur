<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Sources;

use Manadev\LayeredNavigationMobile\Contracts\MobileBehavior;
use Manadev\LayeredNavigationMobile\Registries\MobileBehaviorRegistry;

class MobileBehaviorSource implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var MobileBehaviorRegistry
     */
    protected $mobileBehaviorRegistry;

    public function __construct(MobileBehaviorRegistry $mobileBehaviorRegistry) {
        $this->mobileBehaviorRegistry = $mobileBehaviorRegistry;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray() {
        $result = [];
        /** @var MobileBehavior $mobileBehavior */
        foreach ($this->mobileBehaviorRegistry->getItems() as $key => $mobileBehavior) {
            $result[] = ['value' => $key, 'label' => $mobileBehavior->getLabel()];
        }

        return $result;
    }
}