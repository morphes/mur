<?php
namespace Magento\Analytics\Block\Adminhtml\System\Config\SubscriptionStatusLabel;

/**
 * Interceptor class for @see \Magento\Analytics\Block\Adminhtml\System\Config\SubscriptionStatusLabel
 */
class Interceptor extends \Magento\Analytics\Block\Adminhtml\System\Config\SubscriptionStatusLabel implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Analytics\Model\SubscriptionStatusProvider $labelStatusProvider, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $labelStatusProvider, $data);
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
