<?php
namespace Magento\Sales\Block\Adminhtml\Order\Create\Form;

/**
 * Interceptor class for @see \Magento\Sales\Block\Adminhtml\Order\Create\Form
 */
class Interceptor extends \Magento\Sales\Block\Adminhtml\Order\Create\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Model\Session\Quote $sessionQuote, \Magento\Sales\Model\AdminOrder\Create $orderCreate, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Customer\Model\Metadata\FormFactory $customerFormFactory, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Framework\Locale\CurrencyInterface $localeCurrency, \Magento\Customer\Model\Address\Mapper $addressMapper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $sessionQuote, $orderCreate, $priceCurrency, $jsonEncoder, $customerFormFactory, $customerRepository, $localeCurrency, $addressMapper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderDataJson()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOrderDataJson');
        if (!$pluginInfo) {
            return parent::getOrderDataJson();
        } else {
            return $this->___callPlugins('getOrderDataJson', func_get_args(), $pluginInfo);
        }
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
