<?php
namespace Magento\Catalog\Block\Rss\Category;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Rss\Category
 */
class Interceptor extends \Magento\Catalog\Block\Rss\Category implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Magento\Catalog\Model\Rss\Category $rssModel, \Magento\Framework\App\Rss\UrlBuilderInterface $rssUrlBuilder, \Magento\Catalog\Helper\Image $imageHelper, \Magento\Customer\Model\Session $customerSession, \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $categoryFactory, $rssModel, $rssUrlBuilder, $imageHelper, $customerSession, $categoryRepository, $data);
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
