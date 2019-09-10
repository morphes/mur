<?php
namespace Bss\CmsPageImportExport\Controller\Adminhtml\Export\Export;

/**
 * Interceptor class for @see \Bss\CmsPageImportExport\Controller\Adminhtml\Export\Export
 */
class Interceptor extends \Bss\CmsPageImportExport\Controller\Adminhtml\Export\Export implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Bss\CmsPageImportExport\Model\ResourceModel\Export\CmsPage $export, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Stdlib\DateTime\DateTime $datetime, \Magento\Framework\Filesystem\Io\File $io, \Magento\Framework\File\Csv $csv, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory)
    {
        $this->___init();
        parent::__construct($context, $export, $filesystem, $datetime, $io, $csv, $fileFactory, $resultRawFactory);
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
