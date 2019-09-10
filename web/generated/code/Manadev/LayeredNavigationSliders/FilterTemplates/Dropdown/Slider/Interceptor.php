<?php
namespace Manadev\LayeredNavigationSliders\FilterTemplates\Dropdown\Slider;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationSliders\FilterTemplates\Dropdown\Slider
 */
class Interceptor extends \Manadev\LayeredNavigationSliders\FilterTemplates\Dropdown\Slider implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Manadev\LayeredNavigation\RequestParser $requestParser, \Manadev\ProductCollection\Factory $factory, \Manadev\LayeredNavigation\Configuration $configuration, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Locale\CurrencyInterface $localCurrency, \Manadev\LayeredNavigation\Helper $layeredNavHelper)
    {
        $this->___init();
        parent::__construct($requestParser, $factory, $configuration, $storeManager, $localCurrency, $layeredNavHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function getScriptConfig($sliderData, \Manadev\LayeredNavigation\Models\Filter $filter, \Manadev\LayeredNavigation\Blocks\FilterRenderer $block, \Manadev\LayeredNavigation\EngineFilter $engineFilter)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getScriptConfig');
        if (!$pluginInfo) {
            return parent::getScriptConfig($sliderData, $filter, $block, $engineFilter);
        } else {
            return $this->___callPlugins('getScriptConfig', func_get_args(), $pluginInfo);
        }
    }
}
