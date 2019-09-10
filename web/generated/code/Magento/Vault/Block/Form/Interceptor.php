<?php
namespace Magento\Vault\Block\Form;

/**
 * Interceptor class for @see \Magento\Vault\Block\Form
 */
class Interceptor extends \Magento\Vault\Block\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Vault\Model\Ui\Adminhtml\TokensConfigProvider $tokensConfigProvider, \Magento\Payment\Model\CcConfigProvider $ccConfigProvider, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $tokensConfigProvider, $ccConfigProvider, $data);
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
