<?php
namespace MageArray\News\Controller\View\Index;

/**
 * Interceptor class for @see \MageArray\News\Controller\View\Index
 */
class Interceptor extends \MageArray\News\Controller\View\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory, \MageArray\News\Helper\Index\View $viewHelper, \MageArray\News\Helper\Data $dataHelper, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $coreRegistry, \MageArray\News\Model\NewspostFactory $newspostFactory)
    {
        $this->___init();
        parent::__construct($context, $resultForwardFactory, $viewHelper, $dataHelper, $resultPageFactory, $coreRegistry, $newspostFactory);
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
