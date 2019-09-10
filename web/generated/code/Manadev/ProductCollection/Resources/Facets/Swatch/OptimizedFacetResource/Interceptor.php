<?php
namespace Manadev\ProductCollection\Resources\Facets\Swatch\OptimizedFacetResource;

/**
 * Interceptor class for @see \Manadev\ProductCollection\Resources\Facets\Swatch\OptimizedFacetResource
 */
class Interceptor extends \Manadev\ProductCollection\Resources\Facets\Swatch\OptimizedFacetResource implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Manadev\ProductCollection\Factory $factory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Manadev\ProductCollection\Configuration $configuration, \Manadev\ProductCollection\Resources\HelperResource $helperResource, \Manadev\ProductCollection\FacetSorter $sorter, \Manadev\ProductCollection\Resources\Facets\Dropdown\StandardFacetResource $standardFacetResource, \Manadev\Core\Resources\TemporaryResource $temporaryResource, $resourcePrefix = null)
    {
        $this->___init();
        parent::__construct($context, $factory, $storeManager, $configuration, $helperResource, $sorter, $standardFacetResource, $temporaryResource, $resourcePrefix);
    }

    /**
     * {@inheritdoc}
     */
    public function getFields(\Manadev\ProductCollection\Contracts\Facet $facet)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFields');
        if (!$pluginInfo) {
            return parent::getFields($facet);
        } else {
            return $this->___callPlugins('getFields', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addJoins(\Magento\Framework\DB\Select $select, \Manadev\ProductCollection\Contracts\Facet $facet)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addJoins');
        if (!$pluginInfo) {
            return parent::addJoins($select, $facet);
        } else {
            return $this->___callPlugins('addJoins', func_get_args(), $pluginInfo);
        }
    }
}
