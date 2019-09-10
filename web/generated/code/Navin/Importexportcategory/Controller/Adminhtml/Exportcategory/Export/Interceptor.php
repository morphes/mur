<?php
namespace Navin\Importexportcategory\Controller\Adminhtml\Exportcategory\Export;

/**
 * Interceptor class for @see \Navin\Importexportcategory\Controller\Adminhtml\Exportcategory\Export
 */
class Interceptor extends \Navin\Importexportcategory\Controller\Adminhtml\Exportcategory\Export implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Store\Model\StoreManagerInterface $storeManagerInterface, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Magento\Catalog\Model\ResourceModel\Product\Collection $prodcollection, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($resultForwardFactory, $storeManagerInterface, $categoryFactory, $prodcollection, $resultRawFactory, $fileFactory, $context);
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
