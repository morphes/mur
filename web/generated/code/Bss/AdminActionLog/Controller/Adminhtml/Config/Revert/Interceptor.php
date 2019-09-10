<?php
namespace Bss\AdminActionLog\Controller\Adminhtml\Config\Revert;

/**
 * Interceptor class for @see \Bss\AdminActionLog\Controller\Adminhtml\Config\Revert
 */
class Interceptor extends \Bss\AdminActionLog\Controller\Adminhtml\Config\Revert implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Bss\AdminActionLog\Model\ResourceModel\RevertConfig $revertConfig, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->___init();
        parent::__construct($context, $revertConfig, $resultPageFactory);
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
