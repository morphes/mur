<?php
namespace Dotdigitalgroup\Email\Block\Adminhtml\Logviewer;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Adminhtml\Logviewer
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Adminhtml\Logviewer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Context $context, \Dotdigitalgroup\Email\Helper\File $file, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $file, $data);
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
