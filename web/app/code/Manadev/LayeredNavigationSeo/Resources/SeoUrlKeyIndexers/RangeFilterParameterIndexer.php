<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers;

use Manadev\Seo\Enums\UrlKeySubType;

class RangeFilterParameterIndexer extends FilterParameterIndexer
{
    protected function getUrlKeySubType() {
        return UrlKeySubType::RANGE_FILTER_PARAMETER;
    }
}