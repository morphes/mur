<?php
namespace Manadev\LayeredNavigationSettings\Controller\Adminhtml\Filter\Grid;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationSettings\Controller\Adminhtml\Filter\Grid
 */
class Interceptor extends \Manadev\LayeredNavigationSettings\Controller\Adminhtml\Filter\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory)
    {
        $this->___init();
        parent::__construct($context, $resultLayoutFactory);
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
