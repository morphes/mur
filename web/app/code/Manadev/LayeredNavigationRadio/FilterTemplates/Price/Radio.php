<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationRadio\FilterTemplates\Price;

use Manadev\LayeredNavigation\FilterTemplates\Price\TextMultipleSelect;
use Manadev\LayeredNavigation\Models\Filter;

class Radio extends TextMultipleSelect
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