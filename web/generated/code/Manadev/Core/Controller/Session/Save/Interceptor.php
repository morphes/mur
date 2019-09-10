<?php
namespace Manadev\Core\Controller\Session\Save;

/**
 * Interceptor class for @see \Manadev\Core\Controller\Session\Save
 */
class Interceptor extends \Manadev\Core\Controller\Session\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Catalog\Model\Session $session, \Psr\Log\LoggerInterface $logger)
    {
        $this->___init();
        parent::__construct($context, $session, $logger);
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
