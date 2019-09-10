<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Resources\Facets\Category;

use Magento\Store\Model\Store;

class ChildAllFacetResource extends AbstractChildFacetResource
{
    protected function _filterCategorySelect($categorySelect) {
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        $rootPath = "1/" . $store->getRootCategoryId(). "/";
        $categorySelect->where($this->getConnection()->quoteInto("path like ?", $rootPath . "%"));
    }
}