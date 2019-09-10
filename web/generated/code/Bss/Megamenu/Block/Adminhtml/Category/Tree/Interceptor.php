<?php
namespace Bss\Megamenu\Block\Adminhtml\Category\Tree;

/**
 * Interceptor class for @see \Bss\Megamenu\Block\Adminhtml\Category\Tree
 */
class Interceptor extends \Bss\Megamenu\Block\Adminhtml\Category\Tree implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Bss\Megamenu\Helper\Data $helper, \Magento\Backend\Model\UrlInterface $urlBuilder, \Bss\Megamenu\Model\MenuFactory $modelMenuFactory, \Bss\Megamenu\Model\ConfigFactory $configFactory, \Magento\Framework\App\ResourceConnection $resource, \Bss\Megamenu\Model\MenuStoresFactory $menuStoresFactory)
    {
        $this->___init();
        parent::__construct($context, $helper, $urlBuilder, $modelMenuFactory, $configFactory, $resource, $menuStoresFactory);
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
