<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Resources\Facets\Category;

class ParentChildrenFacetResource extends AbstractChildFacetResource
{
    protected function _filterCategorySelect($categorySelect) {
        $facet = $this->getFacet();
        $currentCategory = $facet->getAppliedCategory() ?: $facet->getCurrentCategory();

        // Parents
        $categorySelect->where($this->getConnection()->quoteInto("`main_table`.`entity_id` in (?)", $currentCategory->getPathIds()));
        // Children
        $directChildLevel = $currentCategory->getLevel() + 1;
        $categorySelect->orWhere($this->getConnection()->quoteInto("`main_table`.`level` = " . $directChildLevel ." AND `main_table`.`path` like ?", "%/".$currentCategory->getId(). "/%"));

        if($this->treeConfig->isShowSiblingIfNoChild()) {
            // Include siblings
            $categorySelect->orWhere($this->getConnection()->quoteInto("`main_table`.`parent_id` = ?", $currentCategory->getParentId()));
        }
    }

    protected function getCategoryData() {
        if(!$this->treeConfig->isShowSiblingIfNoChild()) {
            return parent::getCategoryData();
        }

        $facet = $this->getFacet();
        $currentCategory = $facet->getAppliedCategory() ?: $facet->getCurrentCategory();
        $categorySelect = $this->_initCategorySelect();
        $categoriesData = $this->getConnection()->fetchAssoc($categorySelect);

        $hasChild = false;
        foreach($categoriesData as $categoryData) {
            if($categoryData['parent_id'] == $currentCategory->getId()) {
                $hasChild = true;
                break;
            }
        }

        if($hasChild) {
            // If current category has children, remove its siblings.
            foreach ($categoriesData as $i => $categoryData) {
                if($categoryData['parent_id'] == $currentCategory->getParentId() && $currentCategory->getId() != $i) {
                    unset($categoriesData[$i]);
                }
            }
        }

        return $categoriesData;
    }
}