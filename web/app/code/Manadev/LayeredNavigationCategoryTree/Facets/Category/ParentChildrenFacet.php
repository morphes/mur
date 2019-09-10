<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Facets\Category;

class ParentChildrenFacet extends AbstractChildFacet
{
    public function getType() {
        return 'category_parent_children';
    }
}