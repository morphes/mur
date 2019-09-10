<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Core\Exceptions\NotImplemented;
use Manadev\Core\Registries\PageTypes;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\Parser\SettingsData;
use Manadev\Seo\Enums\UrlKeyStatus;

class RedirectedUrlSettings implements UrlSettings
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

    public function __construct(PageTypes $pageTypes, Configuration $configuration) {
        $this->pageTypes = $pageTypes;
        $this->configuration = $configuration;
    }

    /**
     * @return SettingsData
     */
    public function getSettings() {
        if (!$this->settings) {
            $this->settings = new SettingsData([
                'prefix_delimiters' => $this->prefixDelimiters(),
                'prefix_parameter_delimiters' => $this->prefixParameterDelimiters(),
                'prefix_value_delimiters' => $this->prefixValueDelimiters(),
                'prefix_option_delimiters' => $this->prefixOptionDelimiters(),
                'suffix_delimiters' => $this->suffixDelimiters(),
                'suffix_parameter_delimiters' => $this->suffixParameterDelimiters(),
                'suffix_value_delimiters' => $this->suffixValueDelimiters(),
                'suffix_option_delimiters' => $this->suffixOptionDelimiters(),
                'status' => UrlKeyStatus::REDIRECTED,
            ]);
        }
        return $this->settings;
    }

    protected function prefixDelimiters() {
        return $this->delimiters($this->configuration->getPrefixDelimiterHistory());
    }

    protected function prefixParameterDelimiters() {
        return $this->delimiters($this->configuration->getPrefixParameterDelimiterHistory());
    }

    protected function prefixValueDelimiters() {
        return $this->delimiters($this->configuration->getPrefixValueDelimiterHistory());
    }

    protected function prefixOptionDelimiters() {
        return $this->delimiters($this->configuration->getPrefixOptionDelimiterHistory());
    }

    protected function suffixDelimiters() {
        return $this->delimiters($this->configuration->getSuffixDelimiterHistory());
    }

    protected function suffixParameterDelimiters() {
        return $this->delimiters($this->configuration->getSuffixParameterDelimiterHistory());
    }

    protected function suffixValueDelimiters() {
        return $this->delimiters($this->configuration->getSuffixValueDelimiterHistory());
    }

    protected function suffixOptionDelimiters() {
        return $this->delimiters($this->configuration->getSuffixOptionDelimiterHistory());
    }

    protected function delimiters($delimiters) {
        $result = [];
        foreach ($delimiters as $delimiter) {
            $result[$delimiter] = $delimiter;
        }

        return $result;
    }
}