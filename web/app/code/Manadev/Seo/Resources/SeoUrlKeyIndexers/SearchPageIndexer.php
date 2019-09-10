<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources\SeoUrlKeyIndexers;

use Manadev\Seo\Configuration;
use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Zend_Db_Expr;

class SearchPageIndexer extends SeoUrlKeyIndexer
{
    /**
     * @param IndexerScopeData $scope
     * @return Zend_Db_Expr[]
     */
    protected function getFields($scope) {
        $urlKey = "'{$this->configuration->getSearchPageUrlKey($scope->store_id)}'";

        $fields = [
            'type' => "'" . UrlKeyType::PAGE . "'",
            'sub_type' => "'" . UrlKeySubType::SEARCH_PAGE . "'",
            'store_id' => $scope->store_id,
            'unique_key' => $urlKey,
            'reference' => "CONCAT('search-page.')",
            'status' => "'" . UrlKeyStatus::ACTIVE . "'",
            'position' => "0",
            'inferred_url_key' => $urlKey,
            'route' => "'catalogsearch/result/index'",
            'description' => "'" . __('Quick search page') . "'",
        ];

        return $fields;
    }

    /**
     * @param IndexerScopeData $scope
     */
    public function index($scope) {
        if ($this->scopeResource->limitSearchPageIndexing($scope)) {
            return;
        }

        $db = $this->getConnection();
        $fields = $this->dbHelper->wrapIntoZendDbExpr($this->getFields($scope));

        $sql = $this->dbHelper->insert($db, $this->getMainTable(), $fields);

        // run the statement
        $db->query($sql);
    }

    public function getUsedStoreConfigPaths() {
        return [
            Configuration::SEARCH_PAGE_URL_KEY,
        ];
    }
}