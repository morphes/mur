<?php
namespace Magento\Review\Block\Customer\ListCustomer;

/**
 * Interceptor class for @see \Magento\Review\Block\Customer\ListCustomer
 */
class Interceptor extends \Magento\Review\Block\Customer\ListCustomer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Customer\Api\AccountManagementInterface $customerAccountManagement, \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $collectionFactory, \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $customerSession, $subscriberFactory, $customerRepository, $customerAccountManagement, $collectionFactory, $currentCustomer, $data);
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
