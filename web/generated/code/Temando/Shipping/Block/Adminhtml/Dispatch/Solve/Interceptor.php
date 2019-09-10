<?php
namespace Temando\Shipping\Block\Adminhtml\Dispatch\Solve;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\Dispatch\Solve
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\Dispatch\Solve implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Context $context, \Temando\Shipping\Model\Config\ModuleConfigInterface $config, \Temando\Shipping\Model\DispatchProviderInterface $dispatchProvider, \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder, \Magento\Framework\Api\FilterBuilder $filterBuilder, \Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository, \Temando\Shipping\Model\ResourceModel\Shipment\ShipmentReference $shipmentReferenceResource, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $config, $dispatchProvider, $searchCriteriaBuilder, $filterBuilder, $shipmentRepository, $shipmentReferenceResource, $data);
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
