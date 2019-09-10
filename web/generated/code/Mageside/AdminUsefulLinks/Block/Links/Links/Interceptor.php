<?php
namespace Mageside\AdminUsefulLinks\Block\Links\Links;

/**
 * Interceptor class for @see \Mageside\AdminUsefulLinks\Block\Links\Links
 */
class Interceptor extends \Mageside\AdminUsefulLinks\Block\Links\Links implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Cms\Model\Page $page, \Mageside\AdminUsefulLinks\Helper\Config $config, \Magento\Backend\Model\UrlInterface $urlBuilder, $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $page, $config, $urlBuilder, $data);
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
