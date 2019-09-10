<?php
namespace Manadev\LayeredNavigationAjax\Controller\Products\Index;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationAjax\Controller\Products\Index
 */
class Interceptor extends \Manadev\LayeredNavigationAjax\Controller\Products\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Manadev\LayeredNavigationAjax\Configuration $configuration, \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory, \Magento\Framework\Registry $registry, \Manadev\LayeredNavigationAjax\Helper $helper, \Magento\Framework\View\Page\Config $pageConfig)
    {
        $this->___init();
        parent::__construct($context, $configuration, $forwardFactory, $registry, $helper, $pageConfig);
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
