<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\MobileBehaviors;

use Manadev\LayeredNavigationMobile\Configuration;
use Manadev\LayeredNavigationMobile\Contracts\MobileBehavior;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigationMobile\Blocks\MobileNavigation;

class Accordion implements MobileBehavior
{

    /**
     * @var Configuration
     */
    protected $mobileConfig;

    public function __construct(Configuration $mobileConfig) {
        $this->mobileConfig = $mobileConfig;
    }

    /**
     * @param MobileNavigation $block
     * @return string
     */
    public function getJSON($block) {
        $duration = $this->mobileConfig->getEffectDuration();

        return '{"Manadev_Core/js/StatefulAccordionWidget":{"id": "' . $block->getNameInLayout() . '.filters", "openedState": "active", "active": "0", "animate": ' . $duration . '}}';
    }

    public function getLabel() {
        return __("Accordion: one filter expanded at a time");
    }

    /**
     * @param MobileNavigation $block
     * @return string
     */
    public function getParentMageInit($block) {
        return "data-mage-init='{$this->getJSON($block)}'";
    }

    /**
     * @param MobileNavigation $block
     * @param EngineFilter $filter
     * @return string
     */
    public function getChildMageInit($block, $filter) {
        return "data-role='collapsible'";
    }
}