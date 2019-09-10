<?php
namespace Bss\Megamenu\Block\Html\Menu;

/**
 * Interceptor class for @see \Bss\Megamenu\Block\Html\Menu
 */
class Interceptor extends \Bss\Megamenu\Block\Html\Menu implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Bss\Megamenu\Helper\Data $helper, \Bss\Megamenu\Model\Menu $menu, \Bss\Megamenu\Model\ResourceModel\MenuItems\CollectionFactory $menuItemsCollection, \Magento\Theme\Block\Html\Topmenu $topMenuDefault, \Magento\Framework\App\ResourceConnection $resource, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Registry $registry, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $helper, $menu, $menuItemsCollection, $topMenuDefault, $resource, $customerSession, $registry, $data);
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
