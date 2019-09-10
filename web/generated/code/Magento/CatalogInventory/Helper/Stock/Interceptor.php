<?php
namespace Magento\CatalogInventory\Helper\Stock;

/**
 * Interceptor class for @see \Magento\CatalogInventory\Helper\Stock
 */
class Interceptor extends \Magento\CatalogInventory\Helper\Stock implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\CatalogInventory\Model\ResourceModel\Stock\StatusFactory $stockStatusFactory, \Magento\CatalogInventory\Model\Spi\StockRegistryProviderInterface $stockRegistryProvider)
    {
        $this->___init();
        parent::__construct($storeManager, $scopeConfig, $stockStatusFactory, $stockRegistryProvider);
    }

    /**
     * {@inheritdoc}
     */
    public function addIsInStockFilterToCollection($collection)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addIsInStockFilterToCollection');
        if (!$pluginInfo) {
            return parent::addIsInStockFilterToCollection($collection);
        } else {
            return $this->___callPlugins('addIsInStockFilterToCollection', func_get_args(), $pluginInfo);
        }
    }
}
