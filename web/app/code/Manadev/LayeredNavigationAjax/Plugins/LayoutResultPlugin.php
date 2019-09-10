<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Plugins;

use Magento\Framework\Registry;
use Magento\Framework\View\Result\Layout;
use Manadev\Core\Features;

class LayoutResultPlugin
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

    public function aroundRenderResult(Layout $result, callable $proceed, ...$args) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed(...$args);
        }

        if (!($callback = $this->registry->registry('mana_layout_output_callback'))) {
            return $proceed(...$args);
        }

        $update = $result->getLayout()->getUpdate();

        $property = new \ReflectionProperty(\Magento\Framework\View\Model\Layout\Merge::class, 'pageLayout');
        $property->setAccessible(true);
        $property->setValue($update, '');

        $property = new \ReflectionProperty(\Magento\Framework\View\Page\Config::class, 'pageLayout');
        $property->setAccessible(true);
        $property->setValue($result->getConfig(), '');

        return $proceed(...$args);
    }
}