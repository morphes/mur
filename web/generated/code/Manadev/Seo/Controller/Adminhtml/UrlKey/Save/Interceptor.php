<?php
namespace Manadev\Seo\Controller\Adminhtml\UrlKey\Save;

/**
 * Interceptor class for @see \Manadev\Seo\Controller\Adminhtml\UrlKey\Save
 */
class Interceptor extends \Manadev\Seo\Controller\Adminhtml\UrlKey\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Manadev\Seo\Resources\UrlKeyResource $resource)
    {
        $this->___init();
        parent::__construct($context, $resource);
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
