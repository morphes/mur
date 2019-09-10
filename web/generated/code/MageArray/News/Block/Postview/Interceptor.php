<?php
namespace MageArray\News\Block\PostView;

/**
 * Interceptor class for @see \MageArray\News\Block\PostView
 */
class Interceptor extends \MageArray\News\Block\PostView implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \MageArray\News\Model\Newspost $post, \MageArray\News\Model\NewspostFactory $postFactory, \MageArray\News\Model\NewscatFactory $newscatFactory, \MageArray\News\Model\Categories $categories, \MageArray\News\Helper\Data $dataHelper, \Magento\Cms\Model\Template\FilterProvider $filterProvider, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $post, $postFactory, $newscatFactory, $categories, $dataHelper, $filterProvider, $data);
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
