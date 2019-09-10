<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers;

use Magento\Framework\Model\ResourceModel\Db;
use Manadev\Core\Helpers\AttributeHelper;
use Manadev\Core\Helpers\DbHelper;
use Manadev\LayeredNavigation\Registries\FilterTypes;
use Manadev\LayeredNavigation\Configuration as LayeredNavigationConfiguration;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;

abstract class FilterParameterIndexer extends SeoUrlKeyIndexer
{
    /**
     * @var FilterTypes
     */
    protected $filterTypes;

    public function __construct(Db\Context $context, Configuration $configuration, AttributeHelper $attributeHelper,
        DbHelper $dbHelper, IndexerScopeResource $scopeResource, FilterTypes $filterTypes, $connectionName = null)
    {
        parent::__construct($context, $configuration, $attributeHelper, $dbHelper, $scopeResource, $connectionName);
        $this->filterTypes = $filterTypes;
    }

    abstract protected function getUrlKeySubType();

    /**
     * @param IndexerScopeData $scope
     * @return mixed
     */
    protected function getSelect($scope) {
        $db = $this->getConnection();

        $select = $db->select()
            ->distinct()
            ->from(['f' => $this->getTable('mana_filter')], null)
            ->where("`f`.`store_id` = ?", $scope->store_id)
            ->where("`f`.`type` IN (?)", $this->getFilterTypes());

        return $select;
    }

    /**
     * @param IndexerScopeData $scope
     * @return string[]
     */
    protected function getFields($scope) {
        $urlKey = $this->seoify("`f`.`title`", $scope);

        $fields = [
            'type' => "'" . UrlKeyType::PARAMETER . "'",
            'sub_type' => "'" . $this->getUrlKeySubType() . "'",
            'store_id' => $scope->store_id,
            'unique_key' => "CONCAT(`f`.`filter_id`, '-', $urlKey)",
            'reference' => "CONCAT('filter-parameter-', `f`.`filter_id`, '.')",
            'status' => "'" . UrlKeyStatus::ACTIVE . "'",
            'position' => "`f`.`position_in_url`",
            'inferred_url_key' => $urlKey,
            'param_name' => "`f`.`param_name`",
            'requires_param_name' => "`f`.`use_filter_title_in_url`",
            'url_part' => "`f`.`url_part`",
            'filter_id' => "`f`.`filter_id`",
            'description' => "CONCAT('" . __('Filter parameter') . " \\'', " .
                "`f`.`title`, '\\' (ID ', `f`.`filter_id`, ')')",
        ];

        return $fields;
    }

    /**
     * @param IndexerScopeData $scope
     */
    public function index($scope) {
        $db = $this->getConnection();
        $fields = $this->dbHelper->wrapIntoZendDbExpr($this->getFields($scope));
        $select = $this->getSelect($scope);

        $select->columns($fields);

        if ($whereClause = $this->scopeResource->limitFilterParameterIndexing($scope)) {
            $select->where($whereClause);
        }

        // convert SELECT into UPDATE which acts as INSERT on DUPLICATE unique keys
        $sql = $select->insertFromSelect($this->getMainTable(), array_keys($fields));

        // run the statement
        /* @var \Magento\Framework\DB\Adapter\Pdo\Mysql $db */
        $db->multiQuery($sql);
    }

    protected function getFilterTypes() {
        $result = [];

        foreach ($this->filterTypes->getList() as $typeKey => $type) {
            if ($type->getSeoParameterSubType() == $this->getUrlKeySubType()) {
                $result[] = $typeKey;
            }
        }

        return $result;
    }


    public function getUsedStoreConfigPaths() {
        return [
            LayeredNavigationConfiguration::DEFAULT_USE_FILTER_TITLE_IN_URL,
            LayeredNavigationConfiguration::DEFAULT_URL_PART,
        ];
    }
}