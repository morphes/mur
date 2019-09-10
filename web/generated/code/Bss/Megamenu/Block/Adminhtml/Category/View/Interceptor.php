<?php
namespace Bss\Megamenu\Block\Adminhtml\Category\View;

/**
 * Interceptor class for @see \Bss\Megamenu\Block\Adminhtml\Category\View
 */
class Interceptor extends \Bss\Megamenu\Block\Adminhtml\Category\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $coreRegistry, \Magento\Backend\Block\Widget\Context $context, $data = array())
    {
        $this->___init();
        parent::__construct($coreRegistry, $context, $data);
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
