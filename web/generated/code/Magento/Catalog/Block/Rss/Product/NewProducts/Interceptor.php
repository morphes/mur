<?php
namespace Magento\Catalog\Block\Rss\Product\NewProducts;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Rss\Product\NewProducts
 */
class Interceptor extends \Magento\Catalog\Block\Rss\Product\NewProducts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Catalog\Helper\Image $imageHelper, \Magento\Catalog\Model\Rss\Product\NewProducts $rssModel, \Magento\Framework\App\Rss\UrlBuilderInterface $rssUrlBuilder, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $imageHelper, $rssModel, $rssUrlBuilder, $data);
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
