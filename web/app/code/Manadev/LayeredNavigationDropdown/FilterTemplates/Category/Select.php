<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationDropdown\FilterTemplates\Category;

use Manadev\LayeredNavigation\FilterTemplates\Category\TextSingleSelect;
use Manadev\LayeredNavigation\Models\Filter;

class Select extends TextSingleSelect
{
    /**
     * @param Filter $filter
     *
     * @return string
     */
    public function getFilename(Filter $filter) {
        return 'Manadev_LayeredNavigationDropdown::filter/select.phtml';
    }

    public function getTitle() {
        return __('Dropdown');
    }

    public function isDropdown() {
        return true;
    }
}