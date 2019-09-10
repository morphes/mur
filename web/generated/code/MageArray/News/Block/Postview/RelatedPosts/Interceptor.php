<?php
namespace MageArray\News\Block\Postview\RelatedPosts;

/**
 * Interceptor class for @see \MageArray\News\Block\Postview\RelatedPosts
 */
class Interceptor extends \MageArray\News\Block\Postview\RelatedPosts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \MageArray\News\Model\Newspost $post, \MageArray\News\Model\NewspostFactory $postFactory, \Magento\Framework\Registry $coreRegistry, \MageArray\News\Helper\Data $dataHelper, \Magento\Cms\Model\Template\FilterProvider $filterProvider, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $post, $postFactory, $coreRegistry, $dataHelper, $filterProvider, $data);
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
