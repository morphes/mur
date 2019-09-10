<?php
namespace Klarna\Core\Block\Info\Klarna;

/**
 * Interceptor class for @see \Klarna\Core\Block\Info\Klarna
 */
class Interceptor extends \Klarna\Core\Block\Info\Klarna implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Klarna\Core\Model\OrderRepository $orderRepository, \Magento\Framework\Locale\Resolver $locale, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $orderRepository, $locale, $data);
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
