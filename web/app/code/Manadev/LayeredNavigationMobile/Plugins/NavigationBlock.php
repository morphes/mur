<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Plugins;

use Manadev\LayeredNavigation\Blocks\Navigation;
use Manadev\LayeredNavigationMobile\Configuration;

class NavigationBlock
{
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Configuration $configuration) {

        $this->configuration = $configuration;
    }

    public function afterSetLayout(Navigation $navBlock) {
        if($navBlock->getPosition() == "show_on_mobile") {
            $config = [
                'max_width' => $this->configuration->getMobileMaxWidth(),
            ];
            $navBlock->addScript("Manadev_LayeredNavigationMobile/js/manaMobileLayeredNavigation", $config, ".mana-mobile");
        }
    }

    public function _getMaxWidth(){
        return $this->configuration->getMobileMaxWidth();
    }
}