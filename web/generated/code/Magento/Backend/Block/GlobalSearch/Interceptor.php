<?php
namespace Magento\Backend\Block\GlobalSearch;

/**
 * Interceptor class for @see \Magento\Backend\Block\GlobalSearch
 */
class Interceptor extends \Magento\Backend\Block\GlobalSearch implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = array(), array $entityResources = array(), array $entityPaths = array(), \Magento\Backend\Model\GlobalSearch\SearchEntityFactory $searchEntityFactory = null)
    {
        $this->___init();
        parent::__construct($context, $data, $entityResources, $entityPaths, $searchEntityFactory);
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
