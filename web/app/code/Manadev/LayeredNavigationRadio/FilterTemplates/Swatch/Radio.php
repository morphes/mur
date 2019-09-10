<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationRadio\FilterTemplates\Swatch;

use Manadev\LayeredNavigation\FilterTemplates\Swatch\MultipleSelect;
use Manadev\LayeredNavigation\Models\Filter;

class Radio extends MultipleSelect
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