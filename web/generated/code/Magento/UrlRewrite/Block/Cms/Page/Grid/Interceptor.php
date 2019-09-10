<?php
namespace Magento\UrlRewrite\Block\Cms\Page\Grid;

/**
 * Interceptor class for @see \Magento\UrlRewrite\Block\Cms\Page\Grid
 */
class Interceptor extends \Magento\UrlRewrite\Block\Cms\Page\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Cms\Model\Page $cmsPage, \Magento\Cms\Model\ResourceModel\Page\CollectionFactory $collectionFactory, \Magento\Framework\View\Model\PageLayout\Config\BuilderInterface $pageLayoutBuilder, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $backendHelper, $cmsPage, $collectionFactory, $pageLayoutBuilder, $data);
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
