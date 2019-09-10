<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Facets\Price;

use Manadev\LayeredNavigationSliders\Facets\Decimal\AbstractSliderFacet;

class PriceSliderRangeFacet extends AbstractSliderFacet
{
    public function getType() {
         return 'price_slider_range';
    }
}