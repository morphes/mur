<?php
namespace Dotdigitalgroup\Email\Block\Adminhtml\Studio;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Adminhtml\Studio
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Adminhtml\Studio implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\Auth $auth, \Dotdigitalgroup\Email\Helper\Config $configFactory, \Dotdigitalgroup\Email\Helper\Data $dataHelper, \Magento\Backend\Block\Template\Context $context, \Dotdigitalgroup\Email\Model\Apiconnector\Client $client)
    {
        $this->___init();
        parent::__construct($auth, $configFactory, $dataHelper, $context, $client);
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
