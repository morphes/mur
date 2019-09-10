<?php
namespace Bss\Megamenu\Controller\Adminhtml\Item\Edit;

/**
 * Interceptor class for @see \Bss\Megamenu\Controller\Adminhtml\Item\Edit
 */
class Interceptor extends \Bss\Megamenu\Controller\Adminhtml\Item\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Bss\Megamenu\Model\MenuItemsFactory $modelMenuFactory, \Bss\Megamenu\Model\MenuStoresFactory $menuStoresFactory)
    {
        $this->___init();
        parent::__construct($context, $resultJsonFactory, $modelMenuFactory, $menuStoresFactory);
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
