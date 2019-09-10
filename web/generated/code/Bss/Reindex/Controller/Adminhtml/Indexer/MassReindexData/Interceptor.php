<?php
namespace Bss\Reindex\Controller\Adminhtml\Indexer\MassReindexData;

/**
 * Interceptor class for @see \Bss\Reindex\Controller\Adminhtml\Indexer\MassReindexData
 */
class Interceptor extends \Bss\Reindex\Controller\Adminhtml\Indexer\MassReindexData implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Indexer\IndexerRegistry $registry)
    {
        $this->___init();
        parent::__construct($context, $registry);
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
