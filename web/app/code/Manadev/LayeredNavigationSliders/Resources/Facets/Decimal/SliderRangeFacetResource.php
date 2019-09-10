<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Resources\Facets\Decimal;

use Manadev\LayeredNavigationSliders\Facets\Decimal\AbstractSliderFacet;
use Manadev\LayeredNavigationSliders\Resources\Facets\AbstractSliderFacetResource;
use Manadev\ProductCollection\Contracts\Facet;

class SliderRangeFacetResource extends AbstractSliderFacetResource
{
    protected function _construct() {
        $this->_setMainTable('catalog_product_index_eav_decimal');
    }

    protected function formatItem(&$item, $from, $to, Facet $facet) {
        /** @var AbstractSliderFacet $facet */
        $this->helperResource->formatCustomRangeFacet($item, $from, $to, $facet->getNumberFormat(), $facet->isShowThousandSeparator());
    }
}