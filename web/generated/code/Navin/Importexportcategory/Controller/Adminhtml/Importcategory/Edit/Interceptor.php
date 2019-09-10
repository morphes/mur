<?php
namespace Navin\Importexportcategory\Controller\Adminhtml\Importcategory\Edit;

/**
 * Interceptor class for @see \Navin\Importexportcategory\Controller\Adminhtml\Importcategory\Edit
 */
class Interceptor extends \Navin\Importexportcategory\Controller\Adminhtml\Importcategory\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Framework\Registry $registry, \Magento\Framework\Filesystem $fileSystem, \Magento\Framework\Filesystem\Io\File $fileio, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($resultPageFactory, $resultJsonFactory, $registry, $fileSystem, $fileio, $context);
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
