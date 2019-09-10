<?php
namespace Magento\Newsletter\Block\Adminhtml\Template\Preview;

/**
 * Interceptor class for @see \Magento\Newsletter\Block\Adminhtml\Template\Preview
 */
class Interceptor extends \Magento\Newsletter\Block\Adminhtml\Template\Preview implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Newsletter\Model\TemplateFactory $templateFactory, \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $templateFactory, $subscriberFactory, $data);
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
