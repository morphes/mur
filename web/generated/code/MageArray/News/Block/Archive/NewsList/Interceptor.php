<?php
namespace MageArray\News\Block\Archive\NewsList;

/**
 * Interceptor class for @see \MageArray\News\Block\Archive\NewsList
 */
class Interceptor extends \MageArray\News\Block\Archive\NewsList implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \MageArray\News\Model\NewspostFactory $modelNewsFactory, \MageArray\News\Model\NewscommentFactory $newscommentFactory, \MageArray\News\Helper\Data $dataHelper, \Magento\Framework\Registry $coreRegistry, \Magento\Cms\Model\Template\FilterProvider $filterProvider, \MageArray\News\Model\NewscatFactory $category)
    {
        $this->___init();
        parent::__construct($context, $modelNewsFactory, $newscommentFactory, $dataHelper, $coreRegistry, $filterProvider, $category);
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
