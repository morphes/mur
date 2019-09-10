<?php
namespace Magento\Sales\Block\Order\Info\Buttons\Rss;

/**
 * Interceptor class for @see \Magento\Sales\Block\Order\Info\Buttons\Rss
 */
class Interceptor extends \Magento\Sales\Block\Order\Info\Buttons\Rss implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Framework\App\Rss\UrlBuilderInterface $rssUrlBuilder, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $orderFactory, $rssUrlBuilder, $data);
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
