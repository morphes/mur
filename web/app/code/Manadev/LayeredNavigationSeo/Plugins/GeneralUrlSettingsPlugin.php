<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\LayeredNavigation\Resources\HomePageResource;

class GeneralUrlSettingsPlugin
{
    /**
     * @var HomePageResource
     */
    protected $resource;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(HomePageResource $resource, Features $features) {
        $this->resource = $resource;
        $this->features = $features;
    }

    public function aroundHomePageHasParameters($settings, callable $proceed) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed();
        }

        return $this->resource->doesHomePageContainsLayeredNavigation();
    }
}