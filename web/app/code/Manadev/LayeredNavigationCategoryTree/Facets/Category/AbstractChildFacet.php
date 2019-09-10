<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Facets\Category;

use Magento\Catalog\Model\Category;
use Manadev\ProductCollection\Facets\Category\ChildFacet;

abstract class AbstractChildFacet extends ChildFacet
{
    protected $hideEmptyProductCount;
    /**
     * @var
     */
    protected $topLevelCategoriesOnly;
    /**
     * @var Category
     */
    protected $currentCategory;

    public function __construct($name, $appliedCategory, $currentCategory, $hideEmptyProductCount) {
        parent::__construct($name, $appliedCategory, false);
        $this->hideEmptyProductCount = $hideEmptyProductCount;
        $this->currentCategory = $currentCategory;
    }

    public function hideEmptyProductCount() {
        return $this->hideEmptyProductCount;
    }

    /**
     * @return mixed
     */
    public function getTopLevelCategoriesOnly() {
        return $this->topLevelCategoriesOnly;
    }

    /**
     * @return Category
     */
    public function getCurrentCategory() {
        return $this->currentCategory;
    }
}