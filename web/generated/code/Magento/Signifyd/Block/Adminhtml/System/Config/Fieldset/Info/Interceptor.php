<?php
namespace Magento\Signifyd\Block\Adminhtml\System\Config\Fieldset\Info;

/**
 * Interceptor class for @see \Magento\Signifyd\Block\Adminhtml\System\Config\Fieldset\Info
 */
class Interceptor extends \Magento\Signifyd\Block\Adminhtml\System\Config\Fieldset\Info implements \Magento\Framework\Interception\InterceptorInterface
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
