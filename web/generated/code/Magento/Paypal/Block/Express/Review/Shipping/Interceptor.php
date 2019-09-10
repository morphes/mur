<?php
namespace Magento\Paypal\Block\Express\Review\Shipping;

/**
 * Interceptor class for @see \Magento\Paypal\Block\Express\Review\Shipping
 */
class Interceptor extends \Magento\Paypal\Block\Express\Review\Shipping implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\Checkout\Model\Session $resourceSession, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Framework\App\Http\Context $httpContext, \Magento\Quote\Model\Quote\AddressFactory $addressFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $customerSession, $resourceSession, $customerRepository, $httpContext, $addressFactory, $data);
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
