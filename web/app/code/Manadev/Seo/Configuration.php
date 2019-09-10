<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Seo\Resources\ConfigHistoryResource;

class Configuration
{
    const CATEGORY_PAGE_URL_EXTENSION = 'catalog/seo/category_url_suffix';

    const URL_PARSER_LOGGING = 'mana_core/log/seo_url_parser_queries';
    const URL_GENERATOR_LOGGING = 'mana_core/log/seo_url_generator_queries';
    const SEO_URL_KEY_INDEX_QUERY_LOGGING = 'mana_core/log/seo_url_index_queries';
    const URL_PARSER_LOGIC_LOGGING = 'mana_core/log/seo_url_parser_logic';

    const REDIRECT_QUERY_PARAMETERS_TO_PATH_PARAMETERS = 'mana_seo/redirect/query_parameters_to_path_parameters';
    const REDIRECT_CATEGORY_FILTER_TO_SUBCATEGORY_PAGE = 'mana_seo/redirect/category_filter_to_subcategory_page';
    const REDIRECT_TO_CORRECT_PARAMETER_ORDER = 'mana_seo/redirect/to_correct_parameter_order';
    const REDIRECT_NON_SEO_URLS = 'mana_seo/redirect/non_seo_urls';
    const REDIRECT_HOME_CMS_PAGE = 'mana_seo/redirect/home_cms_page_to_home_page';

    const PREFIX_DELIMITER = 'mana_seo/path_delimiters/prefix';
    const SUFFIX_DELIMITER = 'mana_seo/path_delimiters/suffix';
    const CATEGORY_DELIMITER = 'mana_seo/path_delimiters/category';

    const PREFIX_PARAMETER_DELIMITER = 'mana_seo/prefix_delimiters/parameter';
    const PREFIX_VALUE_DELIMITER = 'mana_seo/prefix_delimiters/value';
    const PREFIX_OPTION_DELIMITER = 'mana_seo/prefix_delimiters/option';
    const PREFIX_RANGE_DELIMITER = 'mana_seo/prefix_delimiters/range';
    const PREFIX_CATEGORY_DELIMITER = 'mana_seo/prefix_delimiters/category';

    const SUFFIX_PARAMETER_DELIMITER = 'mana_seo/suffix_delimiters/parameter';
    const SUFFIX_VALUE_DELIMITER = 'mana_seo/suffix_delimiters/value';
    const SUFFIX_OPTION_DELIMITER = 'mana_seo/suffix_delimiters/option';
    const SUFFIX_RANGE_DELIMITER = 'mana_seo/suffix_delimiters/range';
    const SUFFIX_CATEGORY_DELIMITER = 'mana_seo/suffix_delimiters/category';

    const SEARCH_PAGE_URL_KEY = 'mana_seo/url_keys/search_page';
    const SYMBOLS = 'mana_seo/url_keys/symbols';

    const TOOLBAR_PARAMETER_URL_KEY = 'mana_seo/toolbar_%s/url_key';
    const TOOLBAR_PARAMETER_URL_PART = 'mana_seo/toolbar_%s/url_part';
    const TOOLBAR_PARAMETER_POSITION = 'mana_seo/toolbar_%s/position';
    const TOOLBAR_PARAMETER_INCLUDE_IN_CANONICAL_URL = 'mana_seo/toolbar_%s/include_in_canonical_url';
    const TOOLBAR_PARAMETER_FORCE_NO_INDEX = 'mana_seo/toolbar_%s/force_no_index';
    const TOOLBAR_PARAMETER_FORCE_NO_FOLLOW = 'mana_seo/toolbar_%s/force_no_follow';
    const TOOLBAR_PARAMETER_INCLUDE_IN = 'mana_seo/toolbar_%s/include_in_%s';
    const TOOLBAR_PARAMETER_INCLUDE_IN_META_TITLE = 'mana_seo/toolbar_%s/include_in_meta_title';
    const TOOLBAR_PARAMETER_INCLUDE_IN_META_DESCRIPTION = 'mana_seo/toolbar_%s/include_in_meta_description';
    const TOOLBAR_PARAMETER_INCLUDE_IN_META_KEYWORDS = 'mana_seo/toolbar_%s/include_in_meta_keywords';

    const KEYWORD_PARAMETER_URL_KEY = 'mana_seo/search_keyword/url_key';
    const KEYWORD_PARAMETER_USE_PARAMETER_URL_KEY = 'mana_seo/search_keyword/use_parameter_url_key';
    const KEYWORD_PARAMETER_URL_PART = 'mana_seo/search_keyword/url_part';
    const KEYWORD_PARAMETER_POSITION = 'mana_seo/search_keyword/position';
    const KEYWORD_PARAMETER_INCLUDE_IN_CANONICAL_URL = 'mana_seo/search_keyword/include_in_canonical_url';
    const KEYWORD_PARAMETER_FORCE_NO_INDEX = 'mana_seo/search_keyword/force_no_index';
    const KEYWORD_PARAMETER_FORCE_NO_FOLLOW = 'mana_seo/search_keyword/force_no_follow';
    const KEYWORD_PARAMETER_INCLUDE_IN = 'mana_seo/search_keyword/include_in_%s';
    const KEYWORD_PARAMETER_INCLUDE_IN_META_TITLE = 'mana_seo/search_keyword/include_in_meta_title';
    const KEYWORD_PARAMETER_INCLUDE_IN_META_DESCRIPTION = 'mana_seo/search_keyword/include_in_meta_description';
    const KEYWORD_PARAMETER_INCLUDE_IN_META_KEYWORDS = 'mana_seo/search_keyword/include_in_meta_keywords';
    const KEYWORD_PARAMETER_SITEMAP_KEYWORDS = 'mana_seo/search_keyword/sitemap_keywords';

    const EXCLUDED_QUERY_PARAMETERS = 'mana_seo/other/excluded_query_parameters';

    const CANONICAL_URL_RENDERED_ON = 'mana_seo/canonical_url/on_%s';
    const CANONICAL_URL_POINTS_TO_ALL_PRODUCTS = 'mana_seo/canonical_url/points_to_page_with_all_products';
    const CANONICAL_URL_PAGING_BEHAVIOR = 'mana_seo/canonical_url/remove_on_second_and_further_pages';
    const PREV_NEXT_URLS = 'mana_seo/canonical_url/add_rel_prev_rel_next';

    const IS_PRESENT = 'mana_seo/config_present';

    protected $toolbarParameters = [
        'p' => 'page',
        'product_list_order' => 'order',
        'product_list_dir' => 'dir',
        'product_list_mode' => 'mode',
        'product_list_limit' => 'show',
    ];

    protected $history;
    /**
     * @var ConfigHistoryResource
     */
    protected $configHistoryResource;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(ScopeConfigInterface $scopeConfig, ConfigHistoryResource $configHistoryResource,
        StoreManagerInterface $storeManager)
    {
        $this->scopeConfig = $scopeConfig;
        $this->configHistoryResource = $configHistoryResource;
        $this->storeManager = $storeManager;
    }

    public function isParserLoggingEnabled() {
        return $this->scopeConfig->isSetFlag(static::URL_PARSER_LOGGING);
    }

    public function isParserLogicLoggingEnabled() {
        return $this->scopeConfig->isSetFlag(static::URL_PARSER_LOGIC_LOGGING);
    }

    public function isGeneratorLoggingEnabled() {
        return $this->scopeConfig->isSetFlag(static::URL_GENERATOR_LOGGING);
    }

    public function areQueryParametersRedirectedToPathParameters() {
        return $this->scopeConfig->isSetFlag(static::REDIRECT_QUERY_PARAMETERS_TO_PATH_PARAMETERS);
    }


    public function areNonSeoUrlsRedirectedToSeoOnes() {
        return $this->scopeConfig->isSetFlag(static::REDIRECT_NON_SEO_URLS);
    }

    public function isHomeCmsPageRedirectedToHomePage() {
        return $this->scopeConfig->isSetFlag(static::REDIRECT_HOME_CMS_PAGE);
    }

    public function isCategoryFilterRedirectedToSubcategoryPage() {
        return $this->scopeConfig->isSetFlag(static::REDIRECT_CATEGORY_FILTER_TO_SUBCATEGORY_PAGE);
    }

    public function isParameterOrderCorrected() {
        return $this->scopeConfig->isSetFlag(static::REDIRECT_TO_CORRECT_PARAMETER_ORDER);
    }

    public function getPrefixDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::PREFIX_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSuffixDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::SUFFIX_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getCategoryDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::CATEGORY_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getPrefixParameterDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::PREFIX_PARAMETER_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getPrefixValueDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::PREFIX_VALUE_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getPrefixOptionDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::PREFIX_OPTION_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getPrefixRangeDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::PREFIX_RANGE_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getPrefixCategoryDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::PREFIX_CATEGORY_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSuffixParameterDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::SUFFIX_PARAMETER_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSuffixValueDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::SUFFIX_VALUE_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSuffixOptionDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::SUFFIX_OPTION_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSuffixRangeDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::SUFFIX_RANGE_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSuffixCategoryDelimiter($store = null) {
        return $this->scopeConfig->getValue(static::SUFFIX_CATEGORY_DELIMITER,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isSeoUrlKeyIndexQueryLoggingEnabled() {
        return $this->scopeConfig->isSetFlag(static::SEO_URL_KEY_INDEX_QUERY_LOGGING);
    }

    public function getCategoryPageUrlExtension($store = null) {
        return $this->scopeConfig->getValue(static::CATEGORY_PAGE_URL_EXTENSION,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSearchPageUrlKey($store = null) {
        return $this->scopeConfig->getValue(static::SEARCH_PAGE_URL_KEY,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getSymbols($store = null) {
        return json_decode("{" . str_replace("\n", ", \n", trim($this->scopeConfig->getValue(static::SYMBOLS,
            ScopeInterface::SCOPE_STORE, $store))) . "}", true);
    }

    public function getExcludedQueryParameters($store = null) {
        $value = $this->scopeConfig->getValue(static::EXCLUDED_QUERY_PARAMETERS,
            ScopeInterface::SCOPE_STORE, $store);
        return array_filter(array_filter(explode(',', $value), 'trim'));
    }

    public function isPresent() {
        return $this->scopeConfig->isSetFlag(static::IS_PRESENT);
    }

    public function getToolbarParameterUrlKey($parameter, $store = null) {
        return $this->scopeConfig->getValue(sprintf(static::TOOLBAR_PARAMETER_URL_KEY, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getToolbarParameterUrlPart($parameter, $store = null) {
        return $this->scopeConfig->getValue(sprintf(static::TOOLBAR_PARAMETER_URL_PART, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getToolbarParameterPosition($parameter, $store = null) {
        return $this->scopeConfig->getValue(sprintf(static::TOOLBAR_PARAMETER_POSITION, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterIncludedInCanonicalUrl($parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_INCLUDE_IN_CANONICAL_URL, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterNotIndexed($parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_FORCE_NO_INDEX, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterNotFollowed($parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_FORCE_NO_FOLLOW, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterIncludedIn($type, $parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_INCLUDE_IN, $parameter, $type),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterIncludedInMetaTitle($parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_INCLUDE_IN_META_TITLE, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterIncludedInMetaDescription($parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_INCLUDE_IN_META_DESCRIPTION, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isToolbarParameterIncludedInMetaKeywords($parameter, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::TOOLBAR_PARAMETER_INCLUDE_IN_META_KEYWORDS, $parameter),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getKeywordParameterUrlKey($store = null) {
        return $this->scopeConfig->getValue(static::KEYWORD_PARAMETER_URL_KEY,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterUsingParameterUrlKey($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_USE_PARAMETER_URL_KEY,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getKeywordParameterUrlPart($store = null) {
        return $this->scopeConfig->getValue(static::KEYWORD_PARAMETER_URL_PART,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getKeywordParameterPosition($store = null) {
        return $this->scopeConfig->getValue(static::KEYWORD_PARAMETER_POSITION,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterIncludedInCanonicalUrl($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_INCLUDE_IN_CANONICAL_URL,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterNotIndexed($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_FORCE_NO_INDEX,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterNotFollowed($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_FORCE_NO_FOLLOW,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterIncludedIn($type, $store = null) {
        return $this->scopeConfig->isSetFlag(sprintf(static::KEYWORD_PARAMETER_INCLUDE_IN, $type),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterIncludedInMetaTitle($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_INCLUDE_IN_META_TITLE,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterIncludedInMetaDescription($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_INCLUDE_IN_META_DESCRIPTION,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isKeywordParameterIncludedInMetaKeywords($store = null) {
        return $this->scopeConfig->isSetFlag(static::KEYWORD_PARAMETER_INCLUDE_IN_META_KEYWORDS,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getKeywordParameterSitemapKeywords($store = null) {
        return array_filter(array_map('trim', explode("\n",
            $this->scopeConfig->getValue(static::KEYWORD_PARAMETER_SITEMAP_KEYWORDS,
                ScopeInterface::SCOPE_STORE, $store)
        )));
    }


    /**
     * @return array
     */
    public function getToolbarParameters() {
        return $this->toolbarParameters;
    }

    public function getPrefixDelimiterHistory() {
        return $this->getHistory(static::PREFIX_DELIMITER);
    }

    public function getPrefixParameterDelimiterHistory() {
        return $this->getHistory(static::PREFIX_PARAMETER_DELIMITER);
    }

    public function getPrefixValueDelimiterHistory() {
        return $this->getHistory(static::PREFIX_VALUE_DELIMITER);
    }

    public function getPrefixOptionDelimiterHistory() {
        return $this->getHistory(static::PREFIX_OPTION_DELIMITER);
    }

    public function getSuffixDelimiterHistory() {
        return $this->getHistory(static::SUFFIX_DELIMITER);
    }

    public function getSuffixParameterDelimiterHistory() {
        return $this->getHistory(static::SUFFIX_PARAMETER_DELIMITER);
    }

    public function getSuffixValueDelimiterHistory() {
        return $this->getHistory(static::SUFFIX_VALUE_DELIMITER);
    }

    public function getSuffixOptionDelimiterHistory() {
        return $this->getHistory(static::SUFFIX_OPTION_DELIMITER);
    }

    public function getCategoryPageExtensionHistory() {
        return $this->getHistory(\Manadev\Core\Configuration::CATEGORY_PAGE_URL_EXTENSION);
    }

    protected function getHistory($path) {
        if (!$this->history) {
            $this->history = [];

            $records = $this->configHistoryResource->getByScope('stores', $this->storeManager->getStore()->getId());

            foreach ($records as $data) {
                if (!isset($this->history[$data->path])) {
                    $this->history[$data->path] = [];
                }

                $this->history[$data->path][] = $data->value;
            }
        }

        return isset($this->history[$path]) ? $this->history[$path] : [];
    }

    public function isCanonicalUrlRenderedOn($configKey, $store) {
        return $this->scopeConfig->isSetFlag(sprintf(static::CANONICAL_URL_RENDERED_ON, $configKey),
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function isCanonicalUrlPointingToAllProducts($store) {
        return $this->scopeConfig->isSetFlag(static::CANONICAL_URL_POINTS_TO_ALL_PRODUCTS,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function getCanonicalUrlPagingBehavior($store) {
        return $this->scopeConfig->getValue(static::CANONICAL_URL_PAGING_BEHAVIOR,
            ScopeInterface::SCOPE_STORE, $store);
    }

    public function arePrevAndNextUrlsEnabled($store) {
        return $this->scopeConfig->isSetFlag(static::PREV_NEXT_URLS,
            ScopeInterface::SCOPE_STORE, $store);
    }
}