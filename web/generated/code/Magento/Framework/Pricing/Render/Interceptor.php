<?php
namespace Magento\Framework\Pricing\Render;

/**
 * Interceptor class for @see \Magento\Framework\Pricing\Render
 */
class Interceptor extends \Magento\Framework\Pricing\Render implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Pricing\Render\Layout $priceLayout, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $priceLayout, $data);
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
