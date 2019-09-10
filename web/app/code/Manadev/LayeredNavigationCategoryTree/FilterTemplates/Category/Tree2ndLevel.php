<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\FilterTemplates\Category;

use Manadev\ProductCollection\Contracts\ProductCollection;
use Manadev\LayeredNavigation\Models\Filter;

class Tree2ndLevel extends AbstractTree
{
    public function getTitle() {
        return __('Tree (2nd level and down)');
    }

    protected function createFacet($filter, $appliedCategory, $currentCategory) {
        $name = $filter->getData('param_name');
        $hideEmptyProductCount = $filter->getData('minimum_product_count_per_option') > 0;
        return $this->factory->createChild2ndLevelFacet($name,
            $appliedCategory,
            $currentCategory,
            $hideEmptyProductCount);
    }

    public function prepare(ProductCollection $productCollection, Filter $filter) {
        parent::prepare($productCollection, $filter);

        $rootCategoryId = $this->storeManager->getStore()->getRootCategoryId();
        $category = $productCollection->getQuery()->getCategory();
        if ($category->getId() == $rootCategoryId) {
            return;
        }

        while ($category->getParentId() != $rootCategoryId) {
            $category = $category->getParentCategory();
        }

        $this->filterName = $category->getName();
    }
}
