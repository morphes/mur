<?php
namespace Magento\Backend\Block\Widget\Grid\Column\Filter\Select\Extended;

/**
 * Interceptor class for @see \Magento\Backend\Block\Widget\Grid\Column\Filter\Select\Extended
 */
class Interceptor extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Select\Extended implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Framework\DB\Helper $resourceHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $resourceHelper, $data);
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
