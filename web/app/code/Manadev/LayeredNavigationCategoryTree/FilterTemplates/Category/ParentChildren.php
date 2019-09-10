<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\FilterTemplates\Category;

use Manadev\LayeredNavigation\FilterTemplates\Category\TextSingleSelect;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\ProductCollection\Contracts\ProductCollection;
use Magento\Catalog\Model\Category;

class ParentChildren extends TextSingleSelect
{
    public function getTitle() {
        return __('Parents and Children');
    }

    public function getFilename(Filter $filter) {
        return 'Manadev_LayeredNavigationCategoryTree::filter/parents-children.phtml';
    }

    /**
     * Registers filtering and counting logic with product collection
     *
     * @param ProductCollection $productCollection
     * @param Filter $filter
     */
    public function prepare(ProductCollection $productCollection, Filter $filter) {
        $name = $filter->getData('param_name');
        $query = $productCollection->getQuery();
        $appliedCategory = false;

        if (($appliedCategoryId = $this->requestParser->readSingleValueInteger($name)) !== false) {
            $query->getFilterGroup('layered_nav')->addOperand($this->factory->createLayeredCategoryFilter(
                $name, [$appliedCategoryId]));

            /* @var $appliedCategory Category */
            $appliedCategory = $this->categoryRepository->get($appliedCategoryId,
                $this->storeManager->getStore()->getId());
        }


        $query->addFacet($this->factory->createParentChildrenFacet($name, $appliedCategory,
            $query->getCategory(), $filter->getData('hide_filter_with_single_visible_item')));
    }

}