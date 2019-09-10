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

class KeywordParameterIndexer extends SeoUrlKeyIndexer
{
    protected function getFields($scope) {
        $urlKey = "'{$this->configuration->getKeywordParameterUrlKey($scope->store_id)}'";

        $fields = [
            'type' => "'" . UrlKeyType::PARAMETER . "'",
            'sub_type' => "'" . UrlKeySubType::KEYWORD_PARAMETER . "'",
            'store_id' => $scope->store_id,
            'unique_key' => $urlKey,
            'reference' => "CONCAT('keyword-parameter.')",
            'status' => "'" . UrlKeyStatus::ACTIVE . "'",
            'position' => "{$this->configuration->getKeywordParameterPosition($scope->store_id)}",
            'inferred_url_key' => $urlKey,
            'param_name' => "'q'",
            'requires_param_name' => $this->configuration->isKeywordParameterUsingParameterUrlKey($scope->store_id)
                ? "1" : "0",
            'url_part' => "'{$this->configuration->getKeywordParameterUrlPart($scope->store_id)}'",
            'description' => "'" . __("Search keyword parameter") . "'",
        ];

        return $fields;
    }

    /**
     * @param IndexerScopeData $scope
     */
    public function index($scope) {
        if ($this->scopeResource->limitKeywordParameterIndexing($scope)) {
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
            Configuration::KEYWORD_PARAMETER_URL_KEY,
            Configuration::KEYWORD_PARAMETER_USE_PARAMETER_URL_KEY,
            Configuration::KEYWORD_PARAMETER_URL_PART,
            Configuration::KEYWORD_PARAMETER_POSITION,
        ];
    }
}