<?php
namespace Manadev\Core\PageTypes\CategoryPage;

/**
 * Interceptor class for @see \Manadev\Core\PageTypes\CategoryPage
 */
class Interceptor extends \Manadev\Core\PageTypes\CategoryPage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Manadev\Core\Configuration $configuration)
    {
        $this->___init();
        parent::__construct($configuration);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlExtensionHistory()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrlExtensionHistory');
        if (!$pluginInfo) {
            return parent::getUrlExtensionHistory();
        } else {
            return $this->___callPlugins('getUrlExtensionHistory', func_get_args(), $pluginInfo);
        }
    }
}
