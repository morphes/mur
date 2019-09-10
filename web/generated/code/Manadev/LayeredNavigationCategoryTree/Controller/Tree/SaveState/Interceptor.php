<?php
namespace Manadev\LayeredNavigationCategoryTree\Controller\Tree\SaveState;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationCategoryTree\Controller\Tree\SaveState
 */
class Interceptor extends \Manadev\LayeredNavigationCategoryTree\Controller\Tree\SaveState implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Catalog\Model\Session $catalogSession)
    {
        $this->___init();
        parent::__construct($context, $catalogSession);
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
