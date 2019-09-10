<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\IndexerScopeResource;

class IndexerScopeResourcePlugin
{
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Features $features) {
        $this->features = $features;
    }

    /**
     * @param IndexerScopeResource $resource
     * @param callable $proceed
     * @param IndexerScopeData $scope
     * @return string
     */
    public function aroundLimitMarkingKeysAsRedirects($resource, callable $proceed, $scope) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return $proceed($scope);
        }

        $db = $resource->getConnection();

        if (!empty($scope->attribute_ids)) {
            $filterIds = $this->getFilterIdsByAttributeIds($resource, $scope);
            if (!$filterIds) {
                return "1 <> 1";
            }

            return $db->quoteInto("`filter_id` IN (?)", $filterIds);
        }
        elseif (!empty($scope->filter_ids)) {
            return $db->quoteInto("`filter_id` IN (?)", $scope->filter_ids);
        }
        else {
            return $proceed($scope);
        }
    }

    /**
     * @param IndexerScopeResource $resource
     * @param IndexerScopeData $scope
     * @return array
     */
    protected function getFilterIdsByAttributeIds($resource, $scope) {
        $db = $resource->getConnection();

        return $db->fetchCol($db->select()
            ->distinct()
            ->from($resource->getTable('mana_filter'), 'filter_id')
            ->where("`attribute_id` IN (?)", $scope->attribute_ids)
            ->where("`store_id` = ?", $scope->store_id)
        );
    }
}