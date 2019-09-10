<?php
namespace Magento\Customer\Block\Adminhtml\Edit\Tab\View\Grid\Renderer\Item;

/**
 * Interceptor class for @see \Magento\Customer\Block\Adminhtml\Edit\Tab\View\Grid\Renderer\Item
 */
class Interceptor extends \Magento\Customer\Block\Adminhtml\Edit\Tab\View\Grid\Renderer\Item implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Catalog\Helper\Product\Configuration $productConfig, \Magento\Catalog\Helper\Product\ConfigurationPool $productConfigPool, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $productConfig, $productConfigPool, $data);
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
