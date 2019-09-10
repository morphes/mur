<?php
namespace Manadev\Core\Controller\Adminhtml\ProductChooser\Index;

/**
 * Interceptor class for @see \Manadev\Core\Controller\Adminhtml\ProductChooser\Index
 */
class Interceptor extends \Manadev\Core\Controller\Adminhtml\ProductChooser\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\LayoutFactory $layoutFactory)
    {
        $this->___init();
        parent::__construct($context, $layoutFactory);
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
