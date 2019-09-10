<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources\SeoUrlKeyIndexers;

use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;

class CategoryPageIndexer extends SeoUrlKeyIndexer
{
    /**
     * @param IndexerScopeData $scope
     * @return mixed
     */
    protected function getSelect($scope) {
        $db = $this->getConnection();

        $select = $db->select()
            ->distinct()
            ->from(['r' => $this->getTable('url_rewrite')], null)
            ->joinInner(['cat' => $this->getTable('catalog_category_entity')],
                "`cat`.`entity_id` = `r`.`entity_id`", null)
            ->where("`r`.`entity_type` = 'category'")
            ->where("`r`.`store_id` = ?", $scope->store_id);

        $this->attributeHelper->join($select, $this->attributeHelper->get('catalog_category', 'name'),
            "`r`.`entity_id`", 'ng', 'ns', $scope->store_id);

        return $select;
    }

    /**
     * @param IndexerScopeData $scope
     * @return string[]
     */
    protected function getFields($scope) {
        $extension = $this->configuration->getCategoryPageUrlExtension($scope->store_id);
        $extensionLength = mb_strlen($extension);

        $urlKey = "SUBSTRING(`r`.`request_path`, 1, CHAR_LENGTH(`r`.`request_path`) - $extensionLength)";

        $fields = [
            'type' => "'" . UrlKeyType::PAGE . "'",
            'sub_type' => "'" . UrlKeySubType::CATEGORY_PAGE . "'",
            'store_id' => $scope->store_id,
            'unique_key' => "CONCAT(`r`.`entity_id`, '-', $urlKey)",
            'reference' => "CONCAT('category-page-', `r`.`entity_id`, '.')",
            'status' => "IF(`r`.`redirect_type` = 0, '" . UrlKeyStatus::ACTIVE .
                "', '" . UrlKeyStatus::REDIRECTED . "')",
            'position' => "0",
            'category_id' => "`r`.`entity_id`",
            'inferred_url_key' => $urlKey,
            'route' => "'catalog/category/view'",
            'description' => "CONCAT('" . __('Category page') . " \\'', " .
                "COALESCE(`ns`.`value`, `ng`.`value`), '\\' (ID ', `r`.`entity_id`, ')')",
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

        if ($whereClause = $this->scopeResource->limitCategoryPageIndexing($scope)) {
            $select->where($whereClause);
        }

        // convert SELECT into UPDATE which acts as INSERT on DUPLICATE unique keys
        $sql = $select->insertFromSelect($this->getMainTable(), array_keys($fields));

        // run the statement
        $db->query($sql);
    }
}