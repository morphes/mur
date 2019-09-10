<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers;

use Manadev\Seo\Enums\UrlKeySubType;

class CategoryFilterParameterIndexer extends FilterParameterIndexer
{
    protected function getUrlKeySubType() {
        return UrlKeySubType::CATEGORY_FILTER_PARAMETER;
    }
}