<?php
namespace Bss\HtmlSiteMap\Block\ItemsCollection;

/**
 * Interceptor class for @see \Bss\HtmlSiteMap\Block\ItemsCollection
 */
class Interceptor extends \Bss\HtmlSiteMap\Block\ItemsCollection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Helper\Category $categoryHelper, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Magento\Store\Block\Switcher\Interceptor $interceptor, \Bss\HtmlSiteMap\Helper\Data $helper, \Magento\Cms\Model\Page $page, \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState, \Magento\Cms\Model\PageFactory $pageFactory, \Magento\Framework\Data\Helper\PostHelper $postDataHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $categoryCollectionFactory, $productCollectionFactory, $categoryHelper, $categoryFactory, $interceptor, $helper, $page, $categoryFlatState, $pageFactory, $postDataHelper, $data);
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
