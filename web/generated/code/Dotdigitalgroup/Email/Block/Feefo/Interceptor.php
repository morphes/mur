<?php
namespace Dotdigitalgroup\Email\Block\Feefo;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Feefo
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Feefo implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \XSLTProcessor $processor, \DOMDocument $document, \Dotdigitalgroup\Email\Helper\Data $helper, \Magento\Framework\Pricing\Helper\Data $priceHelper, \Dotdigitalgroup\Email\Model\ResourceModel\Review $review, \Magento\Quote\Model\ResourceModel\Quote $quoteResource, \Magento\Quote\Model\QuoteFactory $quoteFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $processor, $document, $helper, $priceHelper, $review, $quoteResource, $quoteFactory, $data);
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
