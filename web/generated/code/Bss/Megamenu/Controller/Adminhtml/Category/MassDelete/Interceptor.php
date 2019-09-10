<?php
namespace Bss\Megamenu\Controller\Adminhtml\Category\MassDelete;

/**
 * Interceptor class for @see \Bss\Megamenu\Controller\Adminhtml\Category\MassDelete
 */
class Interceptor extends \Bss\Megamenu\Controller\Adminhtml\Category\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Ui\Component\MassAction\Filter $filter, \Bss\Megamenu\Model\ResourceModel\MenuStores\CollectionFactory $collectionFactory, \Bss\Megamenu\Model\MenuStoresFactory $menuStoresFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($filter, $collectionFactory, $menuStoresFactory, $context);
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
