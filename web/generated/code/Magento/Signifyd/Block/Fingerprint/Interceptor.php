<?php
namespace Magento\Signifyd\Block\Fingerprint;

/**
 * Interceptor class for @see \Magento\Signifyd\Block\Fingerprint
 */
class Interceptor extends \Magento\Signifyd\Block\Fingerprint implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Signifyd\Model\Config $config, \Magento\Signifyd\Model\SignifydOrderSessionId $signifydOrderSessionId, \Magento\Signifyd\Model\QuoteSession\QuoteSessionInterface $quoteSession, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $config, $signifydOrderSessionId, $quoteSession, $data);
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
