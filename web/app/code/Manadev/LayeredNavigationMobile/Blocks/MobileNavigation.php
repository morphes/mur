<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Blocks;


use Magento\Framework\View\Element\Template;
use Manadev\Core\Helpers\LayoutHelper;
use Manadev\LayeredNavigation\Blocks\Navigation;
use Manadev\LayeredNavigation\Configuration;
use Manadev\LayeredNavigation\Engine;
use Manadev\LayeredNavigation\UrlGenerator;

class MobileNavigation extends Navigation
{
    /**
     * @var \Manadev\LayeredNavigationMobile\Configuration
     */
    protected $mobileConfig;

    public function __construct(
        Template\Context $context,
        Engine $engine,
        UrlGenerator $urlGenerator,
        Configuration $config,
        LayoutHelper $layoutHelper,
        \Manadev\LayeredNavigationMobile\Configuration $mobileConfig,
        array $data = []
    ) {
        parent::__construct($context, $engine, $urlGenerator, $config, $layoutHelper, $data);
        $this->mobileConfig = $mobileConfig;
    }


    public function getMobileBehaviorParent() {
        return $this->mobileConfig->getSelectedMobileBehavior()->getParentMageInit($this);
    }

    public function getMobileBehaviorChild($filter) {
        return $this->mobileConfig->getSelectedMobileBehavior()->getChildMageInit($this, $filter);
    }

    public function getWholeBlockJSON() {
        $duration = $this->mobileConfig->getEffectDuration();
        $isBlockActive = $this->mobileConfig->getWholeBlockInitialState() == "expanded" ? "true" : "false";
        return '{"Manadev_Core/js/StatefulCollapsibleWidget":{"id": "' . $this->getNameInLayout() . '.title", "openedState": "active", "collapsible": true, "animate": '. $duration .', "active": '. $isBlockActive .'}, "Manadev_LayeredNavigation/js/NavigationView": {}}';
    }

    public function getMobileMaxWidth() {
        return $this->mobileConfig->getMobileMaxWidth();
    }
}