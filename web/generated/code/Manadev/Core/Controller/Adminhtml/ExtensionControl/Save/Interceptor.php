<?php
namespace Manadev\Core\Controller\Adminhtml\ExtensionControl\Save;

/**
 * Interceptor class for @see \Manadev\Core\Controller\Adminhtml\ExtensionControl\Save
 */
class Interceptor extends \Manadev\Core\Controller\Adminhtml\ExtensionControl\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Config\ReinitableConfigInterface $scopeConfig, \Magento\Config\Model\ResourceModel\Config $resourceConfig, \Magento\Framework\App\Cache\Manager $cacheManager, \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList)
    {
        $this->___init();
        parent::__construct($context, $scopeConfig, $resourceConfig, $cacheManager, $cacheTypeList);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
