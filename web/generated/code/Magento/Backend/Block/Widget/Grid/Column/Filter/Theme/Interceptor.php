<?php
namespace Magento\Backend\Block\Widget\Grid\Column\Filter\Theme;

/**
 * Interceptor class for @see \Magento\Backend\Block\Widget\Grid\Column\Filter\Theme
 */
class Interceptor extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Theme implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Framework\DB\Helper $resourceHelper, \Magento\Framework\View\Design\Theme\LabelFactory $labelFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $resourceHelper, $labelFactory, $data);
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
