<?php
namespace Manadev\LayeredNavigation\Blocks\FilterRenderer;

/**
 * Interceptor class for @see \Manadev\LayeredNavigation\Blocks\FilterRenderer
 */
class Interceptor extends \Manadev\LayeredNavigation\Blocks\FilterRenderer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Catalog\Helper\Data $catalogHelper, \Magento\Swatches\Helper\Media $mediaHelper, \Manadev\LayeredNavigation\UrlGenerator $urlGenerator, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $catalogHelper, $mediaHelper, $urlGenerator, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function render(\Manadev\LayeredNavigation\EngineFilter $engineFilter)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'render');
        if (!$pluginInfo) {
            return parent::render($engineFilter);
        } else {
            return $this->___callPlugins('render', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAddItemLinkAttributes($engineFilter, $item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAddItemLinkAttributes');
        if (!$pluginInfo) {
            return parent::getAddItemLinkAttributes($engineFilter, $item);
        } else {
            return $this->___callPlugins('getAddItemLinkAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRemoveItemLinkAttributes($engineFilter, $item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRemoveItemLinkAttributes');
        if (!$pluginInfo) {
            return parent::getRemoveItemLinkAttributes($engineFilter, $item);
        } else {
            return $this->___callPlugins('getRemoveItemLinkAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getReplaceItemLinkAttributes($engineFilter, $item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getReplaceItemLinkAttributes');
        if (!$pluginInfo) {
            return parent::getReplaceItemLinkAttributes($engineFilter, $item);
        } else {
            return $this->___callPlugins('getReplaceItemLinkAttributes', func_get_args(), $pluginInfo);
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
