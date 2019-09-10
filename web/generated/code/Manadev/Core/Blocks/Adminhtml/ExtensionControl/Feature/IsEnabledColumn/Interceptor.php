<?php
namespace Manadev\Core\Blocks\Adminhtml\ExtensionControl\Feature\IsEnabledColumn;

/**
 * Interceptor class for @see \Manadev\Core\Blocks\Adminhtml\ExtensionControl\Feature\IsEnabledColumn
 */
class Interceptor extends \Manadev\Core\Blocks\Adminhtml\ExtensionControl\Feature\IsEnabledColumn implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Backend\Block\Widget\Grid\Column\Renderer\Options\Converter $converter, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $converter, $data);
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
