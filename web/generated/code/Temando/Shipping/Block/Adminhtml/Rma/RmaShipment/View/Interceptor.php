<?php
namespace Temando\Shipping\Block\Adminhtml\Rma\RmaShipment\View;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\Rma\RmaShipment\View
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\Rma\RmaShipment\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Context $context, \Temando\Shipping\Model\ResourceModel\Rma\RmaAccess $rmaAccess, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $rmaAccess, $data);
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
