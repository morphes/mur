<?php
namespace Temando\Shipping\Block\Adminhtml\Documentation;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\Documentation
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\Documentation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Temando\Shipping\Model\Shipment\ShipmentProviderInterface $shipmentProvider, \Temando\Shipping\Model\DispatchProviderInterface $dispatchProvider, \Temando\Shipping\Model\ResourceModel\Rma\RmaAccess $rmaAccess, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $shipmentProvider, $dispatchProvider, $rmaAccess, $data);
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
