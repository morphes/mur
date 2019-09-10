<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers;

use Manadev\Seo\Enums\UrlKeySubType;

class OptionFilterParameterIndexer extends FilterParameterIndexer
{
    protected function getUrlKeySubType() {
        return UrlKeySubType::OPTION_FILTER_PARAMETER;
    }
}