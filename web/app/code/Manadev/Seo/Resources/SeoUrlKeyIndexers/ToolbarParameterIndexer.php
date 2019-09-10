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

class ToolbarParameterIndexer extends SeoUrlKeyIndexer
{
    /**
     * @param IndexerScopeData $scope
     * @param string $parameter
     * @param string $configKey
     * @return \string[]
     */
    protected function getFields($scope, $parameter, $configKey) {
        $urlKey = "'{$this->configuration->getToolbarParameterUrlKey($configKey, $scope->store_id)}'";

        $fields = [
            'type' => "'" . UrlKeyType::PARAMETER . "'",
            'sub_type' => "'" . UrlKeySubType::TOOLBAR_PARAMETER . "'",
            'store_id' => $scope->store_id,
            'unique_key' => $urlKey,
            'reference' => "CONCAT('toolbar-parameter-$parameter.')",
            'status' => "'" . UrlKeyStatus::ACTIVE . "'",
            'position' => "{$this->configuration->getToolbarParameterPosition($configKey, $scope->store_id)}",
            'inferred_url_key' => $urlKey,
            'param_name' => "'$parameter'",
            'requires_param_name' => "1",
            'url_part' => "'{$this->configuration->getToolbarParameterUrlPart($configKey, $scope->store_id)}'",
            'description' => "'" . __("%1 toolbar parameter", $parameter) . "'",
        ];

        return $fields;
    }

    /**
     * @param IndexerScopeData $scope
     */
    public function index($scope) {
        if ($this->scopeResource->limitToolbarParameterIndexing($scope)) {
            return;
        }

        $db = $this->getConnection();
        foreach ($this->configuration->getToolbarParameters() as $parameter => $configKey) {
            $fields = $this->dbHelper->wrapIntoZendDbExpr($this->getFields($scope, $parameter, $configKey));

            $sql = $this->dbHelper->insert($db, $this->getMainTable(), $fields);

            // run the statement
            $db->query($sql);
        }
    }

    public function getUsedStoreConfigPaths() {
        $result = [];

        foreach ($this->configuration->getToolbarParameters() as $configKey) {
            $result[] = sprintf(Configuration::TOOLBAR_PARAMETER_URL_KEY, $configKey);
            $result[] = sprintf(Configuration::TOOLBAR_PARAMETER_URL_PART, $configKey);
            $result[] = sprintf(Configuration::TOOLBAR_PARAMETER_POSITION, $configKey);
        }

        return $result;
    }
}