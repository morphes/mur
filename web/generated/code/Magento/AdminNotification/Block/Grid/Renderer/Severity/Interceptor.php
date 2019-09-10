<?php
namespace Magento\AdminNotification\Block\Grid\Renderer\Severity;

/**
 * Interceptor class for @see \Magento\AdminNotification\Block\Grid\Renderer\Severity
 */
class Interceptor extends \Magento\AdminNotification\Block\Grid\Renderer\Severity implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\AdminNotification\Model\Inbox $notice, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $notice, $data);
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
