<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Generation;

use Manadev\LayeredNavigation\RequestParser;
use Manadev\LayeredNavigation\UrlSettings;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\RouterParameterData;
use Manadev\Seo\Data\UrlKeyData;

class RangeFilterParameterGenerator
{
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var UrlSettings
     */
    protected $urlSettings;
    /**
     * @var RequestParser
     */
    protected $requestParser;

    public function __construct(Configuration $configuration, UrlSettings $urlSettings, RequestParser $requestParser) {
        $this->configuration = $configuration;
        $this->urlSettings = $urlSettings;
        $this->requestParser = $requestParser;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $urlKey
     * @return bool
     */
    public function generate($route, $urlKey) {
        $url = '';

        $valueDelimiterMethod = "get" . ucfirst($urlKey->url_part) . "ValueDelimiter";
        $optionDelimiterMethod = "get" . ucfirst($urlKey->url_part) . "OptionDelimiter";
        $rangeDelimiterMethod = "get" . ucfirst($urlKey->url_part) . "RangeDelimiter";

        $ranges = $this->requestParser->readMultipleValueRangeString(
            $route->params['_query'][$urlKey->param_name], true);

        if (!$ranges) {
            return false;
        }

        usort($ranges, function($a, $b) {
            if ($a[0] === '') return -1;
            if ($b[0] === '') return 1;

            if ($a[1] === '') return 1;
            if ($b[1] === '') return -1;

            if ((float)$a[0] < (float)$b[0]) return -1;
            if ((float)$a[0] > (float)$b[0]) return 1;

            return 0;
        });

        foreach ($ranges as $range) {
            if ($url) {
                $url .= $this->configuration->$optionDelimiterMethod();
            }

            $url .= implode($this->configuration->$rangeDelimiterMethod(), $range);
        }

        $url = $urlKey->url_key . $this->configuration->$valueDelimiterMethod() . $url;

        unset($route->params['_query'][$urlKey->param_name]);
        $route->{$urlKey->url_part}[] = new RouterParameterData([
            'url' => $url,
            'position' => $urlKey->position,
        ]);

        return true;
    }

}