<?php
namespace Navin\Importexportcategory\Controller\Adminhtml\Importcategory\Save;

/**
 * Interceptor class for @see \Navin\Importexportcategory\Controller\Adminhtml\Importcategory\Save
 */
class Interceptor extends \Navin\Importexportcategory\Controller\Adminhtml\Importcategory\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory, \Magento\Framework\Filesystem $fileSystem, \Magento\Framework\Module\Dir\Reader $moduleReader, \Magento\Framework\File\Csv $fileCsv, \Magento\Store\Model\StoreManagerInterface $storeManagerInterface, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Filesystem\Io\File $fileio, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($registry, $fileUploaderFactory, $fileSystem, $moduleReader, $fileCsv, $storeManagerInterface, $categoryFactory, $logger, $fileio, $context);
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
