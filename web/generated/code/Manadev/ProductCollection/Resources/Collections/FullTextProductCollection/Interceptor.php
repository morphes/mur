<?php
namespace Manadev\ProductCollection\Resources\Collections\FullTextProductCollection;

/**
 * Interceptor class for @see \Manadev\ProductCollection\Resources\Collections\FullTextProductCollection
 */
class Interceptor extends \Manadev\ProductCollection\Resources\Collections\FullTextProductCollection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactory $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Eav\Model\Config $eavConfig, \Magento\Framework\App\ResourceConnection $resource, \Magento\Eav\Model\EntityFactory $eavEntityFactory, \Magento\Catalog\Model\ResourceModel\Helper $resourceHelper, \Magento\Framework\Validator\UniversalFactory $universalFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Module\Manager $moduleManager, \Magento\Catalog\Model\Indexer\Product\Flat\State $catalogProductFlatState, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Catalog\Model\Product\OptionFactory $productOptionFactory, \Magento\Catalog\Model\ResourceModel\Url $catalogUrl, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Stdlib\DateTime $dateTime, \Magento\Customer\Api\GroupManagementInterface $groupManagement, \Magento\Search\Model\QueryFactory $catalogSearchData, \Magento\Framework\Search\Request\Builder $requestBuilder, \Magento\Search\Model\SearchEngine $searchEngine, \Magento\Framework\Search\Adapter\Mysql\TemporaryStorageFactory $temporaryStorageFactory, \Manadev\Core\Resources\TemporaryResource $temporaryResource, \Manadev\Core\QueryLogger $queryLogger, \Manadev\ProductCollection\Factory $factory, \Manadev\ProductCollection\QueryRunner $queryRunner, \Manadev\Core\Features $features, \Manadev\ProductCollection\FacetGenerator $facetGenerator, \Manadev\ProductCollection\FilterGenerator $filterGenerator, \Manadev\ProductCollection\Configuration $configuration, \Manadev\Core\Profiler $profiler, \Magento\Framework\DB\Adapter\AdapterInterface $connection = null, $searchRequestName = 'catalog_view_container')
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $eavConfig, $resource, $eavEntityFactory, $resourceHelper, $universalFactory, $storeManager, $moduleManager, $catalogProductFlatState, $scopeConfig, $productOptionFactory, $catalogUrl, $localeDate, $customerSession, $dateTime, $groupManagement, $catalogSearchData, $requestBuilder, $searchEngine, $temporaryStorageFactory, $temporaryResource, $queryLogger, $factory, $queryRunner, $features, $facetGenerator, $filterGenerator, $configuration, $profiler, $connection, $searchRequestName);
    }

    /**
     * {@inheritdoc}
     */
    public function load($printQuery = false, $logQuery = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        if (!$pluginInfo) {
            return parent::load($printQuery, $logQuery);
        } else {
            return $this->___callPlugins('load', func_get_args(), $pluginInfo);
        }
    }
}
