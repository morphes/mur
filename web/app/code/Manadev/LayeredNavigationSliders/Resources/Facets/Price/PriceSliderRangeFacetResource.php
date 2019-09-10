<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Resources\Facets\Price;

use Magento\Framework\DB\Select;
use Manadev\LayeredNavigationSliders\Facets\Decimal\AbstractSliderFacet;
use Manadev\LayeredNavigationSliders\Resources\Facets\AbstractSliderFacetResource;
use Manadev\ProductCollection\Contracts\Facet;

class PriceSliderRangeFacetResource extends AbstractSliderFacetResource
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('catalog_product_index_price');
    }

    protected function exprByAttrId(Select $select, $attributeId) {
        return $this->helperResource->getPriceExpression();
    }

    protected function formatItem(&$item, $from, $to, Facet $facet) {
        /** @var AbstractSliderFacet $facet */
        $this->helperResource->formatCustomRangeFacet($item, $from, $to, $facet->getNumberFormat(), $facet->isShowThousandSeparator());
    }
}