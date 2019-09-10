<?php
namespace Mageside\AdminUsefulLinks\Block\Links\Preview;

/**
 * Interceptor class for @see \Mageside\AdminUsefulLinks\Block\Links\Preview
 */
class Interceptor extends \Mageside\AdminUsefulLinks\Block\Links\Preview implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Cms\Model\Page $page, \Mageside\AdminUsefulLinks\Helper\Config $config, \Magento\Backend\Model\UrlInterface $urlBuilder, \Magento\Store\Model\StoreManagerInterface $storeManager, $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $page, $config, $urlBuilder, $storeManager, $data);
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
