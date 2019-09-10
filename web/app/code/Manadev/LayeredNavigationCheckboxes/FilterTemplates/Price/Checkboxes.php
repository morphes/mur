<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCheckboxes\FilterTemplates\Price;

use Manadev\LayeredNavigation\FilterTemplates\Price\TextMultipleSelect;
use Manadev\LayeredNavigation\Models\Filter;

class Checkboxes extends TextMultipleSelect
{
    public function getFilename(Filter $filter) {
        return 'Manadev_LayeredNavigationCheckboxes::filter/checkboxes.phtml';
    }

    public function getTitle() {
        return __('Checkboxes');
    }
}