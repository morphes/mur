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
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;

class FilterOptionIndexer extends SeoUrlKeyIndexer
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
            ->from(['f' => $this->getTable('mana_filter')], null)
            ->joinInner(['o' => $this->getTable('eav_attribute_option')],
                "`o`.`attribute_id` = `f`.`attribute_id`", null)
            ->joinInner(['vg' => $this->getTable('eav_attribute_option_value')],
                $db->quoteInto("`vg`.`option_id` = `o`.`option_id` AND `vg`.`store_id` = ?", 0), null)
            ->joinLeft(['vs' => $this->getTable('eav_attribute_option_value')],
                $db->quoteInto("`vs`.`option_id` = `o`.`option_id` AND `vs`.`store_id` = ?", $scope->store_id), null)
            ->where("`f`.`store_id` = ?", $scope->store_id)
            ->where("`f`.`type` IN (?)", $this->getFilterTypes());

        return $select;
    }

    /**
     * @param IndexerScopeData $scope
     * @return string[]
     */
    protected function getFields($scope) {
        $title = "COALESCE(`vs`.`value`, `vg`.`value`)";
        $urlKey = $this->seoify($title, $scope);

        $fields = [
            'type' => "'" . UrlKeyType::OPTION . "'",
            'sub_type' => "'" . UrlKeySubType::FILTER_OPTION . "'",
            'store_id' => $scope->store_id,
            'unique_key' => "CONCAT(`o`.`option_id`, '-', `f`.`use_filter_title_in_url`, '-', $urlKey)",
            'reference' => "CONCAT('filter-option-', `o`.`option_id`, '.')",
            'status' => "'" . UrlKeyStatus::ACTIVE . "'",
            'position' => "`f`.`position_in_url` * 65536 + `o`.`sort_order`",
            'inferred_url_key' => $urlKey,
            'param_name' => "`f`.`param_name`",
            'requires_param_name' => "`f`.`use_filter_title_in_url`",
            'filter_id' => "`f`.`filter_id`",
            'option_id' => "`o`.`option_id`",
            'description' => "CONCAT('" . __('Option') . " \\'', $title, '\\'', " .
                "'" . __(' of filter') . " \\'', `f`.`title`, '\\'', " .
                "' (ID ', `o`.`option_id`, ')')",
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
            if ($type->getSeoParameterSubType() == UrlKeySubType::OPTION_FILTER_PARAMETER) {
                $result[] = $typeKey;
            }
        }

        return $result;
    }

    public function getFilterParamNames($storeId) {
        $db = $this->getConnection();

        return $db->fetchCol($db->select()
            ->from(['f' => $this->getTable('mana_filter')], new \Zend_Db_Expr("`f`.`param_name`"))
            ->where("`f`.`store_id` = ?", $storeId)
            ->where("`f`.`type` IN (?)", $this->getFilterTypes())
        );
    }
}