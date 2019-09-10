<?php
namespace Magento\Sales\Block\Adminhtml\Reorder\Renderer\Action;

/**
 * Interceptor class for @see \Magento\Sales\Block\Adminhtml\Reorder\Renderer\Action
 */
class Interceptor extends \Magento\Sales\Block\Adminhtml\Reorder\Renderer\Action implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Sales\Helper\Reorder $salesReorder, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $salesReorder, $data);
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
