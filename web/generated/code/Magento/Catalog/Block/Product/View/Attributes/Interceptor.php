<?php
namespace Magento\Catalog\Block\Product\View\Attributes;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Product\View\Attributes
 */
class Interceptor extends \Magento\Catalog\Block\Product\View\Attributes implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $priceCurrency, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getAdditionalData(array $excludeAttr = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAdditionalData');
        if (!$pluginInfo) {
            return parent::getAdditionalData($excludeAttr);
        } else {
            return $this->___callPlugins('getAdditionalData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fetchView($fileName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'fetchView');
        if (!$pluginInfo) {
            return parent::fetchView($fileName);
        } else {
            return $this->___callPlugins('fetchView', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toHtml');
        if (!$pluginInfo) {
            return parent::toHtml();
        } else {
            return $this->___callPlugins('toHtml', func_get_args(), $pluginInfo);
        }
    }
}
