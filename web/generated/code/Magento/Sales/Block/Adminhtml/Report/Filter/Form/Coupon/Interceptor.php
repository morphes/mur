<?php
namespace Magento\Sales\Block\Adminhtml\Report\Filter\Form\Coupon;

/**
 * Interceptor class for @see \Magento\Sales\Block\Adminhtml\Report\Filter\Form\Coupon
 */
class Interceptor extends \Magento\Sales\Block\Adminhtml\Report\Filter\Form\Coupon implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Sales\Model\Order\ConfigFactory $orderConfig, \Magento\SalesRule\Model\ResourceModel\Report\RuleFactory $reportRule, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $orderConfig, $reportRule, $data);
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
