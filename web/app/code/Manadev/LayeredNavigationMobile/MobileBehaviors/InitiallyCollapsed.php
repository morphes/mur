<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\MobileBehaviors;

use Manadev\LayeredNavigationMobile\Contracts\MobileBehavior;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigationMobile\Blocks\MobileNavigation;

class InitiallyCollapsed implements MobileBehavior
{

    /**
     * @param MobileNavigation $block
     * @param EngineFilter $filter
     * @return string
     */
    public function getJSON($block, $filter) {
        return '{"Manadev_Core/js/StatefulCollapsibleWidget":{"id": "' . $block->getNameInLayout() . '.' .
            $filter->getFilter()->getData('param_name') . '.filter", "openedState": "active", "animate": 150, "active": false}}';
    }
    public function getLabel() {
        return __("Initially collapsed; expanded manually");
    }

    /**
     * @param MobileNavigation $block
     * @return string
     */
    public function getParentMageInit($block) {
        return "";
    }

    /**
     * @param MobileNavigation $block
     * @param EngineFilter $filter
     * @return string
     */
    public function getChildMageInit($block, $filter) {
        return "data-mage-init = '{$this->getJSON($block, $filter)}'";
    }
}