<?php
namespace Manadev\ProductCollection\Resources\Facets\Swatch\StandardFacetResource;

/**
 * Interceptor class for @see \Manadev\ProductCollection\Resources\Facets\Swatch\StandardFacetResource
 */
class Interceptor extends \Manadev\ProductCollection\Resources\Facets\Swatch\StandardFacetResource implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Manadev\ProductCollection\Factory $factory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Manadev\ProductCollection\Configuration $configuration, \Manadev\ProductCollection\Resources\HelperResource $helperResource, \Magento\Eav\Model\Config $config, \Manadev\ProductCollection\FacetSorter $sorter, \Magento\Swatches\Helper\Data $swatchHelper, $resourcePrefix = null)
    {
        $this->___init();
        parent::__construct($context, $factory, $storeManager, $configuration, $helperResource, $config, $sorter, $swatchHelper, $resourcePrefix);
    }

    /**
     * {@inheritdoc}
     */
    public function getAdditionalData($options)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAdditionalData');
        if (!$pluginInfo) {
            return parent::getAdditionalData($options);
        } else {
            return $this->___callPlugins('getAdditionalData', func_get_args(), $pluginInfo);
        }
    }
}
