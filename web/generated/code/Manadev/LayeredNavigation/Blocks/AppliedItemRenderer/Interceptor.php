<?php
namespace Manadev\LayeredNavigation\Blocks\AppliedItemRenderer;

/**
 * Interceptor class for @see \Manadev\LayeredNavigation\Blocks\AppliedItemRenderer
 */
class Interceptor extends \Manadev\LayeredNavigation\Blocks\AppliedItemRenderer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Manadev\LayeredNavigation\UrlGenerator $urlGenerator, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $urlGenerator, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getRemoveLinkAttributes($engineFilter, $item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRemoveLinkAttributes');
        if (!$pluginInfo) {
            return parent::getRemoveLinkAttributes($engineFilter, $item);
        } else {
            return $this->___callPlugins('getRemoveLinkAttributes', func_get_args(), $pluginInfo);
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
