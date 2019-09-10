<?php
namespace Magento\Config\Block\System\Config\Form\Fieldset;

/**
 * Interceptor class for @see \Magento\Config\Block\System\Config\Form\Fieldset
 */
class Interceptor extends \Magento\Config\Block\System\Config\Form\Fieldset implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Backend\Model\Auth\Session $authSession, \Magento\Framework\View\Helper\Js $jsHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $authSession, $jsHelper, $data);
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
