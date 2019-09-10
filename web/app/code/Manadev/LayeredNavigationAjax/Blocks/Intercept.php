<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Blocks;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Request\Http as Request;
use Manadev\LayeredNavigationAjax\Configuration;
use Manadev\LayeredNavigationAjax\Helper;
use Manadev\Core\Helper as CoreHelper;
use Magento\Framework\View\Layout;
use Magento\Framework\View\Layout\Element;

class Intercept extends Template
{
    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var CoreHelper
     */
    protected $coreHelper;
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Template\Context $context, Helper $helper, CoreHelper $coreHelper,
        Configuration $configuration, array $data = [])
    {
        parent::__construct($context, $data);
        $this->helper = $helper;
        $this->coreHelper = $coreHelper;
        $this->configuration = $configuration;
    }

    public function refreshAfterCategoryChange($block) {
        $this->refreshBlock('after_category_change', $block);
    }

    public function refreshStayingInSameCategory($block) {
        $this->refreshBlock('staying_in_same_category', $block);
    }

    protected function refreshBlock($event, $block) {
        $key = "blocks_refreshed_$event";
        if ($blocks = $this->getData($key) ?: '') {
            $blocks .= ',';
        }
        $this->setData($key, $blocks . $block);
    }

    public function getJson() {
        return json_encode([
            'selector' => $this->getSelector(),
            'current_params' => $this->getCurrentParams(),
            'url' => $this->getAjaxUrl(),
            'selector_translations' => $this->getSelectorTranslations(),
            'integrate_with_history' => $this->configuration->isIntegrationWithBrowserHistoryEnabled(),
            'show_overlay' => $this->configuration->areUserActionsBlockedDuringAjax(),
            'show_indicator' => $this->configuration->isAjaxIndicatorShown(),
            'use_button_to_apply_filters' => $this->configuration->getFilterApplyMode() == 'after_pressing_apply_button',
            'scroll_to_top_mode' => $this->configuration->getScrollToTopMode(),
            'ga_account' => $this->configuration->getGoogleAnalyticsAccountId(),
            'log_to_console' => $this->configuration->isLoggingInBrowserConsoleEnabled(),
            'apply_filter_text' => __('Apply filters'),
        ]);
    }

    protected function getCurrentParams() {
        /* @var Request $request */
        $request = $this->getRequest();
        return $request->getQuery()->toString();
    }

    protected function getAjaxUrl() {
        /* @var Request $request */
        $request = $this->getRequest();

        $query = ['_route' => str_replace('/', '_', $this->coreHelper->getCurrentRoute())];

        foreach ($request->getUserParams() as $key => $value) {
            $query["_$key"] = $value;
        }

        return $this->getUrl('mana_layerednavigationajax/products/', ['_query' => $query]);
    }

    protected function getSelectorTranslations() {
        $result = [];
        $layout = $this->getLayout();

        foreach (array_keys($this->helper->getAjaxRefreshedBlockNames($layout)) as $blockName) {
            if (!$layout->isContainer($blockName)) {
                continue;
            }

            $property = new \ReflectionProperty(Layout::class, 'structure');
            $property->setAccessible(true);

            /* @var Layout\Data\Structure $structure */
            $structure = $property->getValue($layout);

            if ($htmlId = $structure->getAttribute($blockName, Element::CONTAINER_OPT_HTML_ID)) {
                $result['#'. $this->helper->getBlockWrapperId($blockName)] = '#' . $htmlId;
                continue;
            }

            if (!($htmlTag = $structure->getAttribute($blockName, Element::CONTAINER_OPT_HTML_TAG))) {
                continue;
            }

            if ($htmlClass = $structure->getAttribute($blockName, Element::CONTAINER_OPT_HTML_CLASS)) {
                $result['#' . $this->helper->getBlockWrapperId($blockName)] =
                    $htmlTag . '.' . implode('.', preg_split('/\s+/', $htmlClass));
            }
        }

        return $result;
    }
}