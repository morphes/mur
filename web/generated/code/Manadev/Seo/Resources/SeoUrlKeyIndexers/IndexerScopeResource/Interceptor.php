<?php
namespace Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;

/**
 * Interceptor class for @see \Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource
 */
class Interceptor extends \Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, $connectionName = null)
    {
        $this->___init();
        parent::__construct($context, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    public function limitMarkingKeysAsRedirects($scope)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'limitMarkingKeysAsRedirects');
        if (!$pluginInfo) {
            return parent::limitMarkingKeysAsRedirects($scope);
        } else {
            return $this->___callPlugins('limitMarkingKeysAsRedirects', func_get_args(), $pluginInfo);
        }
    }
}
