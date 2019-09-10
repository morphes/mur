<?php
namespace MageArray\News\Controller\Adminhtml\Newspost\RelatedProducts;

/**
 * Interceptor class for @see \MageArray\News\Controller\Adminhtml\Newspost\RelatedProducts
 */
class Interceptor extends \MageArray\News\Controller\Adminhtml\Newspost\RelatedProducts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MageArray\News\Model\NewspostFactory $newspostFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Backend\Helper\Js $jsHelper, \Magento\Store\Model\StoreManagerInterface $storeManager, \MageArray\News\Model\Newspost\Image $imageModel, \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory, \Magento\Framework\App\ResourceConnection $resource, \MageArray\News\Helper\Data $dataHelper)
    {
        $this->___init();
        parent::__construct($context, $newspostFactory, $coreRegistry, $fileFactory, $resultPageFactory, $resultLayoutFactory, $resultForwardFactory, $resultRawFactory, $jsHelper, $storeManager, $imageModel, $uploaderFactory, $resource, $dataHelper);
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
