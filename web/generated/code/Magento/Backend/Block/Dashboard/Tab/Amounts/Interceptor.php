<?php
namespace Magento\Backend\Block\Dashboard\Tab\Amounts;

/**
 * Interceptor class for @see \Magento\Backend\Block\Dashboard\Tab\Amounts
 */
class Interceptor extends \Magento\Backend\Block\Dashboard\Tab\Amounts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Reports\Model\ResourceModel\Order\CollectionFactory $collectionFactory, \Magento\Backend\Helper\Dashboard\Data $dashboardData, \Magento\Backend\Helper\Dashboard\Order $dataHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $collectionFactory, $dashboardData, $dataHelper, $data);
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
