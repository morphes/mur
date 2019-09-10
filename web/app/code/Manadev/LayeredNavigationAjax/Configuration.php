<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Configuration
{
    const REDIRECT_CATEGORY_FILTER_TO_SUBCATEGORY_PAGE = 'mana_seo/redirect/category_filter_to_subcategory_page';
    const INTEGRATE_WITH_BROWSER_HISTORY = 'mana_layered_navigation/ajax/history';
    const BLOCK_USER_ACTIONS = 'mana_layered_navigation/ajax/overlay';
    const SHOW_INDICATOR = 'mana_layered_navigation/ajax/indicator';
    const FILTER_APPLY_MODE = 'mana_layered_navigation/ajax/apply_filters';
    const SCROLL_TO_TOP_MODE = 'mana_layered_navigation/ajax/scroll_to_top';
    const GOOGLE_ANALYTICS_ACCOUNT = 'mana_layered_navigation/ajax/google_analytics_account';
    const MAGE_GOOGLE_ANALYTICS_ENABLED = 'google/analytics/active';
    const MAGE_GOOGLE_ANALYTICS_ACCOUNT = 'google/analytics/account';
    const LOG_AJAX_ACTIVITY_TO_BROWSER_CONSOLE = 'mana_core/log/ajax_activity_in_browser_console';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isCategoryFilterRedirectedToSubcategoryPage() {
        return $this->scopeConfig->isSetFlag(static::REDIRECT_CATEGORY_FILTER_TO_SUBCATEGORY_PAGE);
    }

    public function isIntegrationWithBrowserHistoryEnabled() {
        return $this->scopeConfig->isSetFlag(static::INTEGRATE_WITH_BROWSER_HISTORY);
    }

    public function areUserActionsBlockedDuringAjax() {
        return $this->scopeConfig->isSetFlag(static::BLOCK_USER_ACTIONS);
    }

    public function isAjaxIndicatorShown() {
        return $this->scopeConfig->isSetFlag(static::SHOW_INDICATOR);
    }

    public function getFilterApplyMode() {
        return $this->scopeConfig->getValue(static::FILTER_APPLY_MODE);
    }

    public function getScrollToTopMode() {
        return $this->scopeConfig->getValue(static::SCROLL_TO_TOP_MODE);
    }

    public function getGoogleAnalyticsAccountId() {
        if ($result = $this->scopeConfig->getValue(static::GOOGLE_ANALYTICS_ACCOUNT)) {
            return $result;
        }

        if (!$this->scopeConfig->isSetFlag(static::MAGE_GOOGLE_ANALYTICS_ENABLED)) {
            return '';
        }

        return $this->scopeConfig->getValue(static::MAGE_GOOGLE_ANALYTICS_ACCOUNT);
    }

    public function isLoggingInBrowserConsoleEnabled() {
        return $this->scopeConfig->isSetFlag(static::LOG_AJAX_ACTIVITY_TO_BROWSER_CONSOLE);
    }
}