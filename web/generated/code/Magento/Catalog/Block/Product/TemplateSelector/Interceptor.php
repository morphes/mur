<?php
namespace Magento\Catalog\Block\Product\TemplateSelector;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Product\TemplateSelector
 */
class Interceptor extends \Magento\Catalog\Block\Product\TemplateSelector implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setColFactory, \Magento\Framework\Registry $registry, \Magento\Catalog\Model\ResourceModel\Helper $resourceHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $setColFactory, $registry, $resourceHelper, $data);
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
