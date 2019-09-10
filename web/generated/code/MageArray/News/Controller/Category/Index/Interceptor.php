<?php
namespace MageArray\News\Controller\Category\Index;

/**
 * Interceptor class for @see \MageArray\News\Controller\Category\Index
 */
class Interceptor extends \MageArray\News\Controller\Category\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \MageArray\News\Helper\Index\View $viewHelper, \MageArray\News\Helper\Data $dataHelper, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageArray\News\Model\NewscatFactory $newscatFactory)
    {
        $this->___init();
        parent::__construct($context, $viewHelper, $dataHelper, $resultPageFactory, $newscatFactory);
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
