<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Plugins;

use Magento\Framework\Registry;
use Manadev\Core\Features;

class LayoutPlugin
{
    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Registry $registry, Features $features) {
        $this->registry = $registry;
        $this->features = $features;
    }

    public function aroundGetOutput($layout, callable $proceed) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed();
        }

        if (!($callback = $this->registry->registry('mana_layout_output_callback'))) {
            return $proceed();
        }

        if (($result = $callback($layout)) === null) {
            return $proceed();
        }

        return $result;
    }
}