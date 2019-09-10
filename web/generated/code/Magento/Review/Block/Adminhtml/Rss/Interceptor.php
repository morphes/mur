<?php
namespace Magento\Review\Block\Adminhtml\Rss;

/**
 * Interceptor class for @see \Magento\Review\Block\Adminhtml\Rss
 */
class Interceptor extends \Magento\Review\Block\Adminhtml\Rss implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Review\Model\Rss $rssModel, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $storeManager, $rssModel, $data);
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
