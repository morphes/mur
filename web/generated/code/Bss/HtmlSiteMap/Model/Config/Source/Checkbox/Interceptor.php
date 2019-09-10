<?php
namespace Bss\HtmlSiteMap\Model\Config\Source\Checkbox;

/**
 * Interceptor class for @see \Bss\HtmlSiteMap\Model\Config\Source\Checkbox
 */
class Interceptor extends \Bss\HtmlSiteMap\Model\Config\Source\Checkbox implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Cms\Model\Page $page, \Magento\Cms\Model\PageFactory $pageFactory)
    {
        $this->___init();
        parent::__construct($page, $pageFactory);
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
