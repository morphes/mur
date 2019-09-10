<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Enums;

use Manadev\Core\Source;

class UrlKeySubType extends Source
{
    // `sub_type` field, when `type` = PAGE
    const CATEGORY_PAGE = 'category_page';
    const CMS_PAGE = 'cms_page';
    const SEARCH_PAGE = 'search_page';

    // `sub_type` field, when `type` = PARAMETER
    const OPTION_FILTER_PARAMETER = 'option_filter_parameter';
    const RANGE_FILTER_PARAMETER = 'range_filter_parameter';
    const CATEGORY_FILTER_PARAMETER = 'category_filter_parameter';
    const TOOLBAR_PARAMETER = 'toolbar_parameter';
    const KEYWORD_PARAMETER = 'keyword_parameter';

    // `sub_type` field, when `type` = OPTION
    const FILTER_OPTION = 'filter_option';
    const CATEGORY_OPTION = 'category_option';

    public function getPageTypes() {
        return [
            static::CATEGORY_PAGE => __('Category Page'),
            static::CMS_PAGE => __('CMS Page'),
            static::SEARCH_PAGE => __('Quick Search Page'),
        ];
    }

    public function getParameterTypes() {
        return [
            static::TOOLBAR_PARAMETER => __('Toolbar Parameter'),
            static::KEYWORD_PARAMETER => __('Keyword Parameter'),
        ];
    }

    public function getOptionTypes() {
        return [];
    }

    public function getOptions() {
        return array_merge($this->getPageTypes(), $this->getParameterTypes(), $this->getOptionTypes());
    }
}