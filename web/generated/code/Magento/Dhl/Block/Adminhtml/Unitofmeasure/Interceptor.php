<?php
namespace Magento\Dhl\Block\Adminhtml\Unitofmeasure;

/**
 * Interceptor class for @see \Magento\Dhl\Block\Adminhtml\Unitofmeasure
 */
class Interceptor extends \Magento\Dhl\Block\Adminhtml\Unitofmeasure implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Dhl\Model\Carrier $carrierDhl, \Magento\Shipping\Helper\Carrier $carrierHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $carrierDhl, $carrierHelper, $data);
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
