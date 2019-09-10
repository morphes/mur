<?php
namespace MageArray\News\Controller\Index\Index;

/**
 * Interceptor class for @see \MageArray\News\Controller\Index\Index
 */
class Interceptor extends \MageArray\News\Controller\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \MageArray\News\Helper\Index\View $viewHelper, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageArray\News\Helper\Data $dataHelper, \Magento\Framework\Controller\Result\Forward $resultForward)
    {
        $this->___init();
        parent::__construct($context, $viewHelper, $resultPageFactory, $dataHelper, $resultForward);
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
