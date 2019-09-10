<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources\SeoUrlKeyIndexers;

use Magento\Framework\Model\ResourceModel\Db;
use Manadev\Core\Helpers\AttributeHelper;
use Manadev\Core\Helpers\DbHelper;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\IndexerScopeData;

abstract class SeoUrlKeyIndexer extends Db\AbstractDb
{
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var AttributeHelper
     */
    protected $attributeHelper;
    /**
     * @var IndexerScopeResource
     */
    protected $scopeResource;
    /**
     * @var DbHelper
     */
    protected $dbHelper;

    public function __construct(Db\Context $context, Configuration $configuration, AttributeHelper $attributeHelper,
        DbHelper $dbHelper, IndexerScopeResource $scopeResource, $connectionName = null)
    {
        parent::__construct($context, $connectionName);
        $this->configuration = $configuration;
        $this->attributeHelper = $attributeHelper;
        $this->scopeResource = $scopeResource;
        $this->dbHelper = $dbHelper;
    }

    public function getUsedStoreConfigPaths() {
        return [];
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('mana_url_key', 'id');
    }

    /**
     * @param IndexerScopeData $scope
     */
    abstract public function index($scope);

    /**
     * @param string $expr
     * @param IndexerScopeData $scope
     * @return string
     */
    protected function seoify($expr, $scope) {
        $db = $this->getConnection();

        $expr = "LOWER($expr)";

        // TODO: continue here
        $symbols = $this->configuration->getSymbols($scope->store_id);

        foreach ($symbols as $symbol => $substitute) {
            $expr = "REPLACE($expr, {$db->quote($symbol)}, {$db->quote($substitute)})";
        }

        return $expr;
    }
}