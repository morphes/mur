<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Sources;

use Manadev\Core\Source;

class CalculateSliderMinMaxSource extends Source
{
    const ALL_PRODUCTS_ON_A_PAGE = 'page';
    const ALL_PRODUCTS_ON_A_STORE = 'store';
    const FILTERED_PRODUCTS_ON_A_PAGE = 'filtered';

    public function getOptions() {
        $result = [
            self::ALL_PRODUCTS_ON_A_PAGE => __("All Products on a Page"),
            self::ALL_PRODUCTS_ON_A_STORE => __("All Products in Store"),
            self::FILTERED_PRODUCTS_ON_A_PAGE => __("Filtered Products on a Page"),
        ];

        return $result;
    }

}