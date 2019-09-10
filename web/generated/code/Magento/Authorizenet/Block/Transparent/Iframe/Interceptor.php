<?php
namespace Magento\Authorizenet\Block\Transparent\Iframe;

/**
 * Interceptor class for @see \Magento\Authorizenet\Block\Transparent\Iframe
 */
class Interceptor extends \Magento\Authorizenet\Block\Transparent\Iframe implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Authorizenet\Helper\DataFactory $dataFactory, \Magento\Framework\Message\ManagerInterface $messageManager, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $dataFactory, $messageManager, $data);
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
