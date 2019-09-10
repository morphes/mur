<?php
namespace Bss\Megamenu\Controller\Adminhtml\Category\Save;

/**
 * Interceptor class for @see \Bss\Megamenu\Controller\Adminhtml\Category\Save
 */
class Interceptor extends \Bss\Megamenu\Controller\Adminhtml\Category\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Bss\Megamenu\Model\MenuStores $menuStores, \Bss\Megamenu\Model\ResourceModel\MenuStores\CollectionFactory $collectionFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory)
    {
        $this->___init();
        parent::__construct($context, $menuStores, $collectionFactory, $resultForwardFactory);
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
