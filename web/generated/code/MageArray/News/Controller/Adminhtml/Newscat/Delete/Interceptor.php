<?php
namespace MageArray\News\Controller\Adminhtml\Newscat\Delete;

/**
 * Interceptor class for @see \MageArray\News\Controller\Adminhtml\Newscat\Delete
 */
class Interceptor extends \MageArray\News\Controller\Adminhtml\Newscat\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MageArray\News\Model\NewscatFactory $newscatFactory)
    {
        $this->___init();
        parent::__construct($context, $newscatFactory);
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
