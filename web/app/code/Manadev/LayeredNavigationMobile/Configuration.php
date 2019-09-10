<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Manadev\LayeredNavigationMobile\Registries\MobileBehaviorRegistry\Proxy as MobileBehaviorRegistry;

class Configuration
{
    const MOBILE_MAX_WIDTH = "mana_layered_navigation/mobile/max_width";
    const MOBILE_BEHAVIOR = "mana_layered_navigation/mobile/behavior";
    const MOBILE_EFFECT_DURATION = "mana_layered_navigation/mobile/effect_duration";
    const MOBILE_WHOLE_BLOCK_INITIAL_STATE = "mana_layered_navigation/mobile/whole_block_initial_state";

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var MobileBehaviorRegistry
     */
    protected $mobileBehaviorRegistry;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        MobileBehaviorRegistry $mobileBehaviorRegistry
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->mobileBehaviorRegistry = $mobileBehaviorRegistry;
    }

    public function getMobileMaxWidth() {
        return $this->scopeConfig->getValue(self::MOBILE_MAX_WIDTH);
    }

    /**
     * @return Contracts\MobileBehavior
     */
    public function getSelectedMobileBehavior() {
        $configuredMobileBehavior = $this->scopeConfig->getValue(self::MOBILE_BEHAVIOR);
        return $this->mobileBehaviorRegistry->get($configuredMobileBehavior);
    }

    public function getEffectDuration() {
        $duration = $this->scopeConfig->getValue(self::MOBILE_EFFECT_DURATION);

        if (!is_numeric($duration)) {
            $duration = 150;
        }

        return $duration;
    }

    public function getWholeBlockInitialState() {
        return $this->scopeConfig->getValue(self::MOBILE_WHOLE_BLOCK_INITIAL_STATE);
    }
}