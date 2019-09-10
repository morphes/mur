<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Resources\Facets\Category;

use Magento\Store\Model\Store;

class Child2ndLevelFacetResource extends AbstractChildFacetResource
{
    protected function _filterCategorySelect($categorySelect) {
        $facet = $this->getFacet();
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        $rootPath = "1/" . $store->getRootCategoryId() . "/";

        $level = 0;
        foreach ($facet->getCurrentCategory()->getPathIds() as $pathId) {
            if ($level == 2) {
                $rootPath .= $pathId . "/";
                break;
            }
            $level++;
        }

        $categorySelect->where($this->getConnection()->quoteInto("path like ?", $rootPath . "%"));
    }
}