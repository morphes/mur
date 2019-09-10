<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Plugins;

use Manadev\Seo\Configuration;

class CategoryPageTypePlugin
{
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function aroundGetUrlExtensionHistory($pageType, callable $proceed) {
        return $this->configuration->getCategoryPageExtensionHistory();
    }
}