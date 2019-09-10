<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationShowMore;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Configuration
{
    const EFFECT_DURATION = 'mana_layered_navigation/show_more/effect_duration';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getEffectDuration() {
        return $this->scopeConfig->getValue(self::EFFECT_DURATION);
    }
}