<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Registries;

class MobileBehaviorRegistry
{
    /**
     * @var \Manadev\LayeredNavigationMobile\Contracts\MobileBehavior[]
     */
    protected $mobileBehaviors;

    public function __construct(array $mobileBehaviors) {
        $this->mobileBehaviors = $mobileBehaviors;
    }

    /**
     * @param $key
     *
     * @return \Manadev\LayeredNavigationMobile\Contracts\MobileBehavior
     */
    public function get($key) {
        return $this->mobileBehaviors[$key];
    }

    public function getItems(){
        return $this->mobileBehaviors;
    }
}