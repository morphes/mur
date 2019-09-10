<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources\SeoUrlKeyIndexers;

use Magento\Framework\Model\ResourceModel\Db;
use Manadev\Core\Exceptions\NotSupported;
use Manadev\Seo\Data\IndexerScopeData;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;

class IndexerScopeResource extends Db\AbstractDb
{
    /**
     * @param IndexerScopeData $scope
     * @return false|string
     * @throws NotSupported
     */
    public function limitMarkingKeysAsRedirects($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            $categoryIds = $this->getEntityIdsByUrlRewriteIds($scope, 'category');
            $cmsPageIds = $this->getEntityIdsByUrlRewriteIds($scope, 'cms-page');
            if (!$categoryIds && !$cmsPageIds) {
                return "1 <> 1";
            }

            return $db->quoteInto("`type` = ?", UrlKeyType::PAGE) . " AND " .
                $db->quoteInto("`sub_type` = ?", UrlKeySubType::CATEGORY_PAGE) . " AND " .
                $db->quoteInto("`category_id` IN (?)", $categoryIds) .
                " OR " .
                $db->quoteInto("`type` = ?", UrlKeyType::PAGE) . " AND " .
                $db->quoteInto("`sub_type` = ?", UrlKeySubType::CMS_PAGE) . " AND " .
                $db->quoteInto("`cms_page_id` IN (?)", $cmsPageIds) .
                " OR " .
                $db->quoteInto("`type` = ?", UrlKeyType::OPTION) . " AND " .
                $db->quoteInto("`sub_type` = ?", UrlKeySubType::CATEGORY_OPTION) . " AND " .
                $db->quoteInto("`category_id` IN (?)", $categoryIds);
        }
        elseif (!empty($scope->url_key_ids)) {
            return $db->quoteInto("`id` IN (?)", $scope->url_key_ids);
        }
        elseif (!empty($scope->attribute_ids)) {
            throw new NotSupported();
        }
        elseif (!empty($scope->filter_ids)) {
            throw new NotSupported();
        }
        else {
            throw new NotSupported();
        }
    }

    /**
     * @param IndexerScopeData $scope
     * @return false|string
     * @throws NotSupported
     */
    public function limitResettingConflictingUrlKeys($scope) {
        return $this->limitMarkingKeysAsRedirects($scope);
    }

    /**
     * @param IndexerScopeData $scope
     * @return false|string
     * @throws NotSupported
     */
    public function limitConflictResolution($scope) {
        return $this->limitMarkingKeysAsRedirects($scope);
    }

    /**
     * @param IndexerScopeData $scope
     * @return false|string
     * @throws NotSupported
     */
    public function limitCategoryPageIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            return $db->quoteInto("`r`.`url_rewrite_id` IN (?)", $scope->url_rewrite_ids);
        }
        elseif (!empty($scope->url_key_ids)) {
            $categoryIds = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'category_id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`category_id` IS NOT NULL")
            );

            return !empty($categoryIds)
                ? $db->quoteInto("`cat`.`entity_id` IN (?)", $categoryIds)
                : "1 <> 1";
        }
        elseif (!empty($scope->attribute_ids)) {
            return "1 <> 1";
        }
        elseif (!empty($scope->filter_ids)) {
            return "1 <> 1";
        }
        else {
            throw new NotSupported();
        }
    }

    public function limitCmsPageIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            return $db->quoteInto("`r`.`url_rewrite_id` IN (?)", $scope->url_rewrite_ids);
        }
        elseif (!empty($scope->url_key_ids)) {
            $cmsPageIds = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'cms_page_id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`cms_page_id` IS NOT NULL")
            );

            return !empty($cmsPageIds)
                ? $db->quoteInto("`p`.`page_id` IN (?)", $cmsPageIds)
                : "1 <> 1";
        }
        elseif (!empty($scope->attribute_ids)) {
            return "1 <> 1";
        }
        elseif (!empty($scope->filter_ids)) {
            return "1 <> 1";
        }
        else {
            throw new NotSupported();
        }
    }

    public function limitSearchPageIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            return true;
        }
        elseif (!empty($scope->url_key_ids)) {
            $searchPageIds = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`sub_type` = ?", UrlKeySubType::SEARCH_PAGE)
            );

            return empty($searchPageIds);
        }
        elseif (!empty($scope->attribute_ids)) {
            return true;
        }
        elseif (!empty($scope->filter_ids)) {
            return true;
        }
        else {
            throw new NotSupported();
        }
    }

    public function limitToolbarParameterIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            return true;
        }
        elseif (!empty($scope->url_key_ids)) {
            $ids = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`sub_type` = ?", UrlKeySubType::TOOLBAR_PARAMETER)
            );

            return empty($ids);
        }
        elseif (!empty($scope->attribute_ids)) {
            return true;
        }
        elseif (!empty($scope->filter_ids)) {
            return true;
        }
        else {
            throw new NotSupported();
        }
    }

    public function limitKeywordParameterIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            return true;
        }
        elseif (!empty($scope->url_key_ids)) {
            $ids = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`sub_type` = ?", UrlKeySubType::KEYWORD_PARAMETER)
            );

            return empty($ids);
        }
        elseif (!empty($scope->attribute_ids)) {
            return true;
        }
        elseif (!empty($scope->filter_ids)) {
            return true;
        }
        else {
            throw new NotSupported();
        }
    }

    public function limitFilterParameterIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            return "1 <> 1";
        }
        elseif (!empty($scope->url_key_ids)) {
            $filterIds = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'filter_id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`filter_id` IS NOT NULL")
            );

            return !empty($filterIds)
                ? $db->quoteInto("`f`.`filter_id` IN (?)", $filterIds)
                : "1 <> 1";
        }
        elseif (!empty($scope->attribute_ids)) {
            return $db->quoteInto("`f`.`attribute_id` IN (?)", $scope->attribute_ids);
        }
        elseif (!empty($scope->filter_ids)) {
            return $db->quoteInto("`f`.`filter_id` IN (?)", $scope->filter_ids);
        }
        else {
            throw new NotSupported();
        }
    }

    public function limitCategoryOptionIndexing($scope) {
        $db = $this->getConnection();

        if ($scope->all) {
            return false;
        }
        elseif (!empty($scope->url_rewrite_ids)) {
            $categoryIds = $this->getEntityIdsByUrlRewriteIds($scope, 'category');

            return !empty($categoryIds)
                ? $db->quoteInto("`cat`.`entity_id` IN (?)", $categoryIds)
                : "1 <> 1";
        }
        elseif (!empty($scope->url_key_ids)) {
            $categoryIds = $db->fetchCol($db->select()
                ->from($this->getMainTable(), 'category_id')
                ->where("`id` IN (?)", $scope->url_key_ids)
                ->where("`category_id` IS NOT NULL")
            );

            return !empty($categoryIds)
                ? $db->quoteInto("`cat`.`entity_id` IN (?)", $categoryIds)
                : "1 <> 1";
        }
        elseif (!empty($scope->attribute_ids)) {
            return "1 <> 1";
        }
        elseif (!empty($scope->filter_ids)) {
            return $db->quoteInto("`f`.`filter_id` IN (?)", $scope->filter_ids);
        }
        else {
            throw new NotSupported();
        }
    }


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('mana_url_key');
    }

    /**
     * @param IndexerScopeData $scope
     * @param $entityType
     * @return array
     */
    protected function getEntityIdsByUrlRewriteIds($scope, $entityType) {
        $db = $this->getConnection();

        return $db->fetchCol($db->select()
            ->distinct()
            ->from(['r' => $this->getTable('url_rewrite')], 'entity_id')
            ->where("`r`.`url_rewrite_id` IN (?)", $scope->url_rewrite_ids)
            ->where("`r`.`store_id` = ?", $scope->store_id)
            ->where("`r`.`entity_type` = ?", $entityType)
        );
    }
}