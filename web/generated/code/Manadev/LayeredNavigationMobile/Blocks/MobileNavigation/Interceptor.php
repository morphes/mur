<?php
namespace Manadev\LayeredNavigationMobile\Blocks\MobileNavigation;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationMobile\Blocks\MobileNavigation
 */
class Interceptor extends \Manadev\LayeredNavigationMobile\Blocks\MobileNavigation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Manadev\LayeredNavigation\Engine $engine, \Manadev\LayeredNavigation\UrlGenerator $urlGenerator, \Manadev\LayeredNavigation\Configuration $config, \Manadev\Core\Helpers\LayoutHelper $layoutHelper, \Manadev\LayeredNavigationMobile\Configuration $mobileConfig, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $engine, $urlGenerator, $config, $layoutHelper, $mobileConfig, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getClearLinkAttributes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getClearLinkAttributes');
        if (!$pluginInfo) {
            return parent::getClearLinkAttributes();
        } else {
            return $this->___callPlugins('getClearLinkAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRemoveFilterLinkAttributes($filter)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRemoveFilterLinkAttributes');
        if (!$pluginInfo) {
            return parent::getRemoveFilterLinkAttributes($filter);
        } else {
            return $this->___callPlugins('getRemoveFilterLinkAttributes', func_get_args(), $pluginInfo);
        }
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
    public function setLayout(\Magento\Framework\View\LayoutInterface $layout)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setLayout');
        if (!$pluginInfo) {
            return parent::setLayout($layout);
        } else {
            return $this->___callPlugins('setLayout', func_get_args(), $pluginInfo);
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
