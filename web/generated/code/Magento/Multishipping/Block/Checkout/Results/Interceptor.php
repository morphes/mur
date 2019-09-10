<?php
namespace Magento\Multishipping\Block\Checkout\Results;

/**
 * Interceptor class for @see \Magento\Multishipping\Block\Checkout\Results
 */
class Interceptor extends \Magento\Multishipping\Block\Checkout\Results implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Multishipping\Model\Checkout\Type\Multishipping $multishipping, \Magento\Customer\Model\Address\Config $addressConfig, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\Framework\Session\SessionManagerInterface $session, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $multishipping, $addressConfig, $orderRepository, $session, $data);
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
