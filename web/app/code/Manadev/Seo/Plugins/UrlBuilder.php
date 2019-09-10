<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Plugins;

use Manadev\Core\Features;
use Manadev\Seo\Generation\UrlGenerator;

class UrlBuilder
{
    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(UrlGenerator $urlGenerator, Features $features) {
        $this->urlGenerator = $urlGenerator;
        $this->features = $features;
    }

    public function aroundGetUrl(\Magento\Framework\Url $obj, callable $proceed, $routePath = null, $routeParams = null)
    {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($routePath, $routeParams);
        }

        if ($route = $this->urlGenerator->generate($routePath, $routeParams)) {
            $routePath = $route->path;
            $routeParams = $route->params;
        }

        return $proceed($routePath, $routeParams);
    }
}