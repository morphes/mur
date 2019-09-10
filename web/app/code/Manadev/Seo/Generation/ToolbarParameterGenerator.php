<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Generation;

use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\RouterParameterData;
use Manadev\Seo\Data\UrlKeyData;

class ToolbarParameterGenerator
{
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $urlKey
     * @return bool
     */
    public function generate($route, $urlKey) {
        $url = $value = $route->params['_query'][$urlKey->param_name];
        $valueDelimiterMethod = "get" . ucfirst($urlKey->url_part) . "ValueDelimiter";

        if ($urlKey->requires_param_name) {
            $url = $urlKey->url_key . $this->configuration->$valueDelimiterMethod() . $url;
        }

        unset($route->params['_query'][$urlKey->param_name]);

        if ($urlKey->param_name == 'p' && $value == 1) {
            return true;
        }

        $route->{$urlKey->url_part}[] = new RouterParameterData([
            'url' => $url,
            'position' => $urlKey->position,
        ]);

        return true;
    }

}