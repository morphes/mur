<?php
namespace Magento\Paypal\Block\Checkout\Onepage\Success\BillingAgreement;

/**
 * Interceptor class for @see \Magento\Paypal\Block\Checkout\Onepage\Success\BillingAgreement
 */
class Interceptor extends \Magento\Paypal\Block\Checkout\Onepage\Success\BillingAgreement implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Customer\Model\Session $customerSession, \Magento\Paypal\Model\Billing\AgreementFactory $agreementFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $checkoutSession, $customerSession, $agreementFactory, $data);
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
