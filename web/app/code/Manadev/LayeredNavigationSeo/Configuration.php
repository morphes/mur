<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Configuration
{

    const SLIDERS_NOT_INDEXED = 'mana_seo/noindex/slider_filter_is_applied';
    const MAX_INDEXED_FILTERS = 'mana_seo/noindex/number_of_applied_filters';
    const INDEXED_FILTERS_COUNTED = 'mana_seo/noindex/count_same_filter_options_as_one';

    const SLIDERS_NOT_FOLLOWED = 'mana_seo/nofollow/slider_filter_is_applied';
    const MAX_FOLLOWED_FILTERS = 'mana_seo/nofollow/number_of_applied_filters';
    const FOLLOWED_FILTERS_COUNTED = 'mana_seo/nofollow/count_same_filter_options_as_one';
    const ADD_NOFOLLOW_TO_LINKS = 'mana_seo/nofollow/add_to_layered_navigation_links';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function areSlidersNotIndexed($store = null) {
        return $this->scopeConfig->isSetFlag(static::SLIDERS_NOT_INDEXED,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getMaxIndexedFilters($store = null) {
        return $this->scopeConfig->getValue(static::MAX_INDEXED_FILTERS,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function areIndexedFiltersCounted($store = null) {
        return $this->scopeConfig->isSetFlag(static::INDEXED_FILTERS_COUNTED,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function areSlidersNotFollowed($store = null) {
        return $this->scopeConfig->isSetFlag(static::SLIDERS_NOT_FOLLOWED,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getMaxFollowedFilters($store = null) {
        return $this->scopeConfig->getValue(static::MAX_FOLLOWED_FILTERS,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function areFollowedFiltersCounted($store = null) {
        return $this->scopeConfig->isSetFlag(static::FOLLOWED_FILTERS_COUNTED,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isNoFollowAddedToLinks($store = null) {
        return $this->scopeConfig->isSetFlag(static::ADD_NOFOLLOW_TO_LINKS,
            ScopeInterface::SCOPE_STORE, $store);
    }
}