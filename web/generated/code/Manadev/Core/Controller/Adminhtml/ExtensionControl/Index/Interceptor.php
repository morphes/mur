<?php
namespace Manadev\Core\Controller\Adminhtml\ExtensionControl\Index;

/**
 * Interceptor class for @see \Manadev\Core\Controller\Adminhtml\ExtensionControl\Index
 */
class Interceptor extends \Manadev\Core\Controller\Adminhtml\ExtensionControl\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Manadev\Core\Features $features)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $features);
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
