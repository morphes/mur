<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Core\Registries\PageTypes;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\Parser\SettingsData;
use Manadev\Seo\Enums\UrlKeyStatus;

class ActiveUrlSettings implements UrlSettings
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
                'status' => UrlKeyStatus::ACTIVE,
            ]);
        }
        return $this->settings;
    }

    protected function prefixDelimiters() {
        $delimiter = $this->configuration->getPrefixDelimiter();
        
        return [$delimiter => $delimiter];
    }

    protected function prefixParameterDelimiters() {
        $delimiter = $this->configuration->getPrefixParameterDelimiter();

        return [$delimiter => $delimiter];
    }

    protected function prefixValueDelimiters() {
        $delimiter = $this->configuration->getPrefixValueDelimiter();

        return [$delimiter => $delimiter];
    }

    protected function prefixOptionDelimiters() {
        $delimiter = $this->configuration->getPrefixOptionDelimiter();

        return [$delimiter => $delimiter];
    }

    protected function suffixDelimiters() {
        $delimiter = $this->configuration->getSuffixDelimiter();

        return [$delimiter => $delimiter];
    }

    protected function suffixParameterDelimiters() {
        $delimiter = $this->configuration->getSuffixParameterDelimiter();

        return [$delimiter => $delimiter];
    }

    protected function suffixValueDelimiters() {
        $delimiter = $this->configuration->getSuffixValueDelimiter();

        return [$delimiter => $delimiter];
    }

    protected function suffixOptionDelimiters() {
        $delimiter = $this->configuration->getSuffixOptionDelimiter();

        return [$delimiter => $delimiter];
    }
}