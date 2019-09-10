<?php
namespace Temando\Shipping\Block\Adminhtml\System\Config\Form\Field\GettingStarted;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\System\Config\Form\Field\GettingStarted
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\System\Config\Form\Field\GettingStarted implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Temando\Shipping\Model\Config\ModuleConfigInterface $moduleConfig, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $moduleConfig, $data);
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
