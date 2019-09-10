<?php
namespace Manadev\Core\Controller\Adminhtml\ExtensionControl\UpdateVersion;

/**
 * Interceptor class for @see \Manadev\Core\Controller\Adminhtml\ExtensionControl\UpdateVersion
 */
class Interceptor extends \Manadev\Core\Controller\Adminhtml\ExtensionControl\UpdateVersion implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Manadev\Core\Features $features, \Manadev\Core\Resources\ExtensionCollectionFactory $collectionFactory)
    {
        $this->___init();
        parent::__construct($context, $features, $collectionFactory);
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
