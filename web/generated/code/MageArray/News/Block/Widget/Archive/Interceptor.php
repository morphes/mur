<?php
namespace MageArray\News\Block\Widget\Archive;

/**
 * Interceptor class for @see \MageArray\News\Block\Widget\Archive
 */
class Interceptor extends \MageArray\News\Block\Widget\Archive implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \MageArray\News\Helper\Data $dataHelper, array $data, \MageArray\News\Model\NewspostFactory $modelNewsFactory)
    {
        $this->___init();
        parent::__construct($context, $dataHelper, $data, $modelNewsFactory);
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
