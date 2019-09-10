<?php
namespace Magento\Reports\Block\Adminhtml\Product\Lowstock\Grid;

/**
 * Interceptor class for @see \Magento\Reports\Block\Adminhtml\Product\Lowstock\Grid
 */
class Interceptor extends \Magento\Reports\Block\Adminhtml\Product\Lowstock\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Reports\Model\ResourceModel\Product\Lowstock\CollectionFactory $lowstocksFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $backendHelper, $lowstocksFactory, $data);
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
