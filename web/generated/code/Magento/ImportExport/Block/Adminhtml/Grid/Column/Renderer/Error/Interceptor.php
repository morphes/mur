<?php
namespace Magento\ImportExport\Block\Adminhtml\Grid\Column\Renderer\Error;

/**
 * Interceptor class for @see \Magento\ImportExport\Block\Adminhtml\Grid\Column\Renderer\Error
 */
class Interceptor extends \Magento\ImportExport\Block\Adminhtml\Grid\Column\Renderer\Error implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $data);
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
