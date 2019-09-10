<?php
namespace Magento\ProductAlert\Block\Product\View\Stock;

/**
 * Interceptor class for @see \Magento\ProductAlert\Block\Product\View\Stock
 */
class Interceptor extends \Magento\ProductAlert\Block\Product\View\Stock implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\ProductAlert\Helper\Data $helper, \Magento\Framework\Registry $registry, \Magento\Framework\Data\Helper\PostHelper $coreHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $helper, $registry, $coreHelper, $data);
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
