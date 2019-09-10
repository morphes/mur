<?php
namespace Bss\Megamenu\Block\Adminhtml\Category\Content;

/**
 * Interceptor class for @see \Bss\Megamenu\Block\Adminhtml\Category\Content
 */
class Interceptor extends \Bss\Megamenu\Block\Adminhtml\Category\Content implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Model\UrlInterface $urlBuilder, \Bss\Megamenu\Model\MenuFactory $modelMenuFactory, \Magento\Cms\Model\ResourceModel\Block\CollectionFactory $blockColFactory, \Magento\Framework\App\ResourceConnection $resource, \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Bss\Megamenu\Model\MenuStoresFactory $menuStoresFactory)
    {
        $this->___init();
        parent::__construct($context, $urlBuilder, $modelMenuFactory, $blockColFactory, $resource, $categoryFlatState, $categoryFactory, $menuStoresFactory);
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
