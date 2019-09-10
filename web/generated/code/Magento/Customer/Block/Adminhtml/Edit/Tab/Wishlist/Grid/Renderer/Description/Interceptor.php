<?php
namespace Magento\Customer\Block\Adminhtml\Edit\Tab\Wishlist\Grid\Renderer\Description;

/**
 * Interceptor class for @see \Magento\Customer\Block\Adminhtml\Edit\Tab\Wishlist\Grid\Renderer\Description
 */
class Interceptor extends \Magento\Customer\Block\Adminhtml\Edit\Tab\Wishlist\Grid\Renderer\Description implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $data);
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
