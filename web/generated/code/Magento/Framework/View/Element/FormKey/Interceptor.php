<?php
namespace Magento\Framework\View\Element\FormKey;

/**
 * Interceptor class for @see \Magento\Framework\View\Element\FormKey
 */
class Interceptor extends \Magento\Framework\View\Element\FormKey implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, \Magento\Framework\Data\Form\FormKey $formKey, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $formKey, $data);
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
