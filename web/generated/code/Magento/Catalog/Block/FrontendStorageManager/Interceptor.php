<?php
namespace Magento\Catalog\Block\FrontendStorageManager;

/**
 * Interceptor class for @see \Magento\Catalog\Block\FrontendStorageManager
 */
class Interceptor extends \Magento\Catalog\Block\FrontendStorageManager implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Catalog\Model\FrontendStorageConfigurationPool $storageConfigurationPool, \Magento\Framework\App\Config $appConfig, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $storageConfigurationPool, $appConfig, $data);
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
