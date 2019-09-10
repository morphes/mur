<?php
namespace Magento\Paypal\Block\Express\Shortcut;

/**
 * Interceptor class for @see \Magento\Paypal\Block\Express\Shortcut
 */
class Interceptor extends \Magento\Paypal\Block\Express\Shortcut implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Paypal\Model\ConfigFactory $paypalConfigFactory, \Magento\Paypal\Model\Express\Checkout\Factory $checkoutFactory, \Magento\Framework\Math\Random $mathRandom, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Magento\Paypal\Helper\Shortcut\ValidatorInterface $shortcutValidator, $paymentMethodCode, $startAction, $checkoutType, $alias, $shortcutTemplate, \Magento\Checkout\Model\Session $checkoutSession = null, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $paypalConfigFactory, $checkoutFactory, $mathRandom, $localeResolver, $shortcutValidator, $paymentMethodCode, $startAction, $checkoutType, $alias, $shortcutTemplate, $checkoutSession, $data);
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
