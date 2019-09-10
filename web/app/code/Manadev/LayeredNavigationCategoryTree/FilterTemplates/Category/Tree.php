<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\FilterTemplates\Category;

class Tree extends AbstractTree
{
    public function getTitle() {
        return __('Tree');
    }

    protected function createFacet($filter, $appliedCategory, $currentCategory) {
        $name = $filter->getData('param_name');
        $hideEmptyProductCount = $filter->getData('minimum_product_count_per_option') > 0;
        return $this->factory->createChildAllFacet($name,
            $appliedCategory,
            $currentCategory,
            $hideEmptyProductCount);
    }
}
