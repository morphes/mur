<?php
namespace Magento\Catalog\Block\Adminhtml\Rss\NotifyStock;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Adminhtml\Rss\NotifyStock
 */
class Interceptor extends \Magento\Catalog\Block\Adminhtml\Rss\NotifyStock implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Catalog\Model\Rss\Product\NotifyStock $rssModel, \Magento\Framework\App\Rss\UrlBuilderInterface $rssUrlBuilder, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $rssModel, $rssUrlBuilder, $data);
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
