<?php
namespace Amazon\Payment\Block\Minicart\Button;

/**
 * Interceptor class for @see \Amazon\Payment\Block\Minicart\Button
 */
class Interceptor extends \Amazon\Payment\Block\Minicart\Button implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Amazon\Payment\Helper\Data $mainHelper, \Magento\Checkout\Model\Session $session, \Magento\Payment\Model\MethodInterface $payment, \Amazon\Core\Helper\Data $coreHelper, \Magento\Framework\App\Request\Http $request, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $localeResolver, $mainHelper, $session, $payment, $coreHelper, $request, $data);
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
