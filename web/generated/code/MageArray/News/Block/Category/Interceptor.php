<?php
namespace MageArray\News\Block\Category;

/**
 * Interceptor class for @see \MageArray\News\Block\Category
 */
class Interceptor extends \MageArray\News\Block\Category implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \MageArray\News\Model\NewspostFactory $modelNewsFactory, \MageArray\News\Model\NewscommentFactory $newscommentFactory, \MageArray\News\Model\NewscatFactory $newscatFactory, \MageArray\News\Helper\Data $dataHelper, \MageArray\News\Model\Categories $categories, \Magento\Cms\Model\Template\FilterProvider $filterProvider, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $modelNewsFactory, $newscommentFactory, $newscatFactory, $dataHelper, $categories, $filterProvider, $data);
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
