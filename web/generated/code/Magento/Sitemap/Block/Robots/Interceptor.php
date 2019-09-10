<?php
namespace Magento\Sitemap\Block\Robots;

/**
 * Interceptor class for @see \Magento\Sitemap\Block\Robots
 */
class Interceptor extends \Magento\Sitemap\Block\Robots implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, \Magento\Store\Model\StoreResolver $storeResolver, \Magento\Sitemap\Model\ResourceModel\Sitemap\CollectionFactory $sitemapCollectionFactory, \Magento\Sitemap\Helper\Data $sitemapHelper, \Magento\Store\Model\StoreManagerInterface $storeManager, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $storeResolver, $sitemapCollectionFactory, $sitemapHelper, $storeManager, $data);
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
