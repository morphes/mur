<?php
namespace Magento\Paypal\Block\Adminhtml\Billing\Agreement\View\Tab\Info;

/**
 * Interceptor class for @see \Magento\Paypal\Block\Adminhtml\Billing\Agreement\View\Tab\Info
 */
class Interceptor extends \Magento\Paypal\Block\Adminhtml\Billing\Agreement\View\Tab\Info implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $customerRepository, $data);
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
