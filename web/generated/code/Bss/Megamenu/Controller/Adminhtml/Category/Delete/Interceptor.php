<?php
namespace Bss\Megamenu\Controller\Adminhtml\Category\Delete;

/**
 * Interceptor class for @see \Bss\Megamenu\Controller\Adminhtml\Category\Delete
 */
class Interceptor extends \Bss\Megamenu\Controller\Adminhtml\Category\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Bss\Megamenu\Model\MenuStoresFactory $menuStoresFactory)
    {
        $this->___init();
        parent::__construct($context, $menuStoresFactory);
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
