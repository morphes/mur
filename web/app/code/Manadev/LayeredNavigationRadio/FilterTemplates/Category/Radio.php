<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationRadio\FilterTemplates\Category;

use Manadev\LayeredNavigation\FilterTemplates\Category\TextSingleSelect;
use Manadev\LayeredNavigation\Models\Filter;

class Radio extends TextSingleSelect
{
    /**
     * @param Filter $filter
     *
     * @return string
     */
    public function getFilename(Filter $filter) {
        return 'Manadev_LayeredNavigationRadio::filter/radio.phtml';
    }

    public function getTitle() {
        return __('Radio');
    }
}