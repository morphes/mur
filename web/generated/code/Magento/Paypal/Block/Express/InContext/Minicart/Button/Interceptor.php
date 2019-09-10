<?php
namespace Magento\Paypal\Block\Express\InContext\Minicart\Button;

/**
 * Interceptor class for @see \Magento\Paypal\Block\Express\InContext\Minicart\Button
 */
class Interceptor extends \Magento\Paypal\Block\Express\InContext\Minicart\Button implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Magento\Paypal\Model\ConfigFactory $configFactory, \Magento\Checkout\Model\Session $session, \Magento\Payment\Model\MethodInterface $payment, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $localeResolver, $configFactory, $session, $payment, $data);
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
