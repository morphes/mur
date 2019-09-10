<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers;

use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;
use Magento\Framework\Model\ResourceModel\Db;
use Manadev\Core\Helpers\AttributeHelper;
use Manadev\Core\Helpers\DbHelper;
use Manadev\LayeredNavigation\Registries\FilterTypes;
use Manadev\Seo\Configuration;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;

class CategoryOptionIndexer extends SeoUrlKeyIndexer
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

    /**
     * @param IndexerScopeData $scope
     * @return mixed
     */
    protected function getSelect($scope) {
        $db = $this->getConnection();

        $select = $db->select()
            ->distinct()
            ->from(['cat' => $this->getTable('catalog_category_entity')], null)
            ->from(['f' => $this->getTable('mana_filter')], null)
            ->where("`f`.`store_id` = ?", $scope->store_id)
            ->where("`f`.`type` IN (?)", $this->getFilterTypes())
            ->where("COALESCE(`ps`.`value`, `pg`.`value`) IS NOT NULL");

        $this->attributeHelper->join($select, $this->attributeHelper->get('catalog_category', 'url_key'),
            "`cat`.`entity_id`", 'pg', 'ps', $scope->store_id);
        $this->attributeHelper->join($select, $this->attributeHelper->get('catalog_category', 'name'),
            "`cat`.`entity_id`", 'ng', 'ns', $scope->store_id);

        return $select;
    }

    /**
     * @param IndexerScopeData $scope
     * @return string[]
     */
    protected function getFields($scope) {
        $urlKey = "COALESCE(`ps`.`value`, `pg`.`value`)";

        $fields = [
            'type' => "'" . UrlKeyType::OPTION . "'",
            'sub_type' => "'" . UrlKeySubType::CATEGORY_OPTION . "'",
            'store_id' => $scope->store_id,
            'unique_key' => "CONCAT(`cat`.`entity_id`, '-', $urlKey)",
            'reference' => "CONCAT('category-option-', `cat`.`entity_id`, '.')",
            'status' => "'" . UrlKeyStatus::ACTIVE . "'",
            'position' => "`f`.`position_in_url` * 65536 + `cat`.`position`",
            'inferred_url_key' => $urlKey,
            'param_name' => "`f`.`param_name`",
            'requires_param_name' => "1",
            'filter_id' => "`f`.`filter_id`",
            'category_id' => "`cat`.`entity_id`",
            'description' => "CONCAT('" . __('Category Option') . " \\'', COALESCE(`ns`.`value`, `ng`.`value`), '\\'', " .
                "' (ID ', `cat`.`entity_id`, ')')",
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

        if ($whereClause = $this->scopeResource->limitCategoryOptionIndexing($scope)) {
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
            if ($type->getSeoParameterSubType() == UrlKeySubType::CATEGORY_FILTER_PARAMETER) {
                $result[] = $typeKey;
            }
        }

        return $result;
    }

    public function getFilterParamNames($storeId) {
        $db = $this->getConnection();

        return $db->fetchCol($db->select()->distinct()->from($this->getMainTable(), 'param_name')
            ->where("`sub_type` = ?", UrlKeySubType::CATEGORY_FILTER_PARAMETER)
            ->where("`store_id` = ?", $storeId)
            ->where("`status` = ?", UrlKeyStatus::ACTIVE));
    }
}