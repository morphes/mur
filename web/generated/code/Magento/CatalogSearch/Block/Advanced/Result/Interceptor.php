<?php
namespace Magento\CatalogSearch\Block\Advanced\Result;

/**
 * Interceptor class for @see \Magento\CatalogSearch\Block\Advanced\Result
 */
class Interceptor extends \Magento\CatalogSearch\Block\Advanced\Result implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\CatalogSearch\Model\Advanced $catalogSearchAdvanced, \Magento\Catalog\Model\Layer\Resolver $layerResolver, \Magento\Framework\UrlFactory $urlFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $catalogSearchAdvanced, $layerResolver, $urlFactory, $data);
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
