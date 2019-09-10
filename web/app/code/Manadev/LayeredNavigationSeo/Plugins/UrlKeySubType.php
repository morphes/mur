<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\Seo\Enums\UrlKeySubType as UrlKeySubTypeEnum;

class UrlKeySubType
{
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Features $features) {
        $this->features = $features;
    }

    public function aroundGetParameterTypes(UrlKeySubTypeEnum $enum, callable $proceed) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return $proceed();
        }

        return array_merge([
            UrlKeySubTypeEnum::OPTION_FILTER_PARAMETER => __('Option Filter Parameter'),
            UrlKeySubTypeEnum::RANGE_FILTER_PARAMETER => __('Range Filter Parameter'),
            UrlKeySubTypeEnum::CATEGORY_FILTER_PARAMETER => __('Category Filter Parameter'),
        ], $proceed());
    }

    public function aroundGetOptionTypes(UrlKeySubTypeEnum $enum, callable $proceed) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return $proceed();
        }

        return array_merge([
            UrlKeySubTypeEnum::FILTER_OPTION => __('Filter Option'),
            UrlKeySubTypeEnum::CATEGORY_OPTION => __('Category Option'),
        ], $proceed());
    }
}