<?php
namespace Temando\Shipping\Block\Adminhtml\Shipping\View\OriginLocation;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\Shipping\View\OriginLocation
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\Shipping\View\OriginLocation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Sales\Api\Data\OrderAddressInterfaceFactory $addressFactory, \Magento\Sales\Model\Order\Address\Renderer $addressRenderer, \Temando\Shipping\Model\Shipment\ShipmentProviderInterface $shipmentProvider, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $addressFactory, $addressRenderer, $shipmentProvider, $data);
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
