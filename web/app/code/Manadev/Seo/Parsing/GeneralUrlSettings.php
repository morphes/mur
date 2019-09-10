<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Core\Registries\PageTypes;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\Parser\SettingsData;

class GeneralUrlSettings implements UrlSettings
{
    /**
     * @var SettingsData
     */
    protected $settings;

    /**
     * @var PageTypes
     */
    protected $pageTypes;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var ActiveUrlSettings
     */
    protected $activeUrlSettings;
    /**
     * @var RedirectedUrlSettings
     */
    protected $redirectedUrlSettings;

    public function __construct(PageTypes $pageTypes, Configuration $configuration,
        ActiveUrlSettings $activeUrlSettings, RedirectedUrlSettings $redirectedUrlSettings)
    {
        $this->pageTypes = $pageTypes;
        $this->configuration = $configuration;
        $this->activeUrlSettings = $activeUrlSettings;
        $this->redirectedUrlSettings = $redirectedUrlSettings;
    }

    /**
     * @return SettingsData
     */
    public function getSettings() {
        if (!$this->settings) {
            $this->settings = new SettingsData([
                'extensions_by_route' => $this->extensionsByRoute(),
                'all_delimiters' => $this->allDelimiters(),
                'home_page_has_parameters' => $this->homePageHasParameters(),
            ]);
        }
        return $this->settings;
    }

    protected function extensionsByRoute() {
        $result = [];

        foreach ($this->pageTypes->getList() as $route => $pageType) {
            $result[$route] = $pageType->getUrlExtensions();
        }

        return $result;
    }

    protected function allDelimiters() {
        return array_merge(
            $this->activeUrlSettings->getSettings()->prefix_parameter_delimiters,
            $this->activeUrlSettings->getSettings()->prefix_value_delimiters,
            $this->activeUrlSettings->getSettings()->prefix_option_delimiters,
            $this->activeUrlSettings->getSettings()->suffix_delimiters,
            $this->activeUrlSettings->getSettings()->suffix_parameter_delimiters,
            $this->activeUrlSettings->getSettings()->suffix_value_delimiters,
            $this->activeUrlSettings->getSettings()->suffix_option_delimiters
        );
    }

    public function homePageHasParameters() {
        return false;
    }
}