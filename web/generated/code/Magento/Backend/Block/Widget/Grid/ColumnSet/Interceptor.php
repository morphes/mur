<?php
namespace Magento\Backend\Block\Widget\Grid\ColumnSet;

/**
 * Interceptor class for @see \Magento\Backend\Block\Widget\Grid\ColumnSet
 */
class Interceptor extends \Magento\Backend\Block\Widget\Grid\ColumnSet implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Backend\Model\Widget\Grid\Row\UrlGeneratorFactory $generatorFactory, \Magento\Backend\Model\Widget\Grid\SubTotals $subtotals, \Magento\Backend\Model\Widget\Grid\Totals $totals, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $generatorFactory, $subtotals, $totals, $data);
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
