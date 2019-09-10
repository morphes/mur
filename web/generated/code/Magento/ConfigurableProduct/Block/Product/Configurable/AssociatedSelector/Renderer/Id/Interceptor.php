<?php
namespace Magento\ConfigurableProduct\Block\Product\Configurable\AssociatedSelector\Renderer\Id;

/**
 * Interceptor class for @see \Magento\ConfigurableProduct\Block\Product\Configurable\AssociatedSelector\Renderer\Id
 */
class Interceptor extends \Magento\ConfigurableProduct\Block\Product\Configurable\AssociatedSelector\Renderer\Id implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Catalog\Helper\Product $productHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $productHelper, $data);
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
