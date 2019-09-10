<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Generation;

use Magento\Framework\ObjectManagerInterface;
use Manadev\LayeredNavigation\Engine;
use Manadev\LayeredNavigation\UrlSettings;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\RouterParameterData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Parsing\ParsingHelper;
use Manadev\Seo\Resources\UrlKeyResource;

class OptionFilterParameterGenerator
{
    /**
     * @var Engine
     */
    protected $engine;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var UrlSettings
     */
    protected $urlSettings;
    /**
     * @var UrlKeyResource
     */
    protected $resource;
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;
    /**
     * @var ParsingHelper
     */
    protected $helper;

    public function __construct(Configuration $configuration, UrlSettings $urlSettings,
        UrlKeyResource $resource, ObjectManagerInterface $objectManager, ParsingHelper $helper)
    {
        $this->configuration = $configuration;
        $this->urlSettings = $urlSettings;
        $this->resource = $resource;
        $this->objectManager = $objectManager;
        $this->helper = $helper;
    }

    protected function getEngine() {
        if (!$this->engine) {
            $this->engine = $this->objectManager->get(Engine::class);
        }

        return $this->engine;
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

        foreach ($this->findOptionUrlKeys($route, $urlKey) as $optionUrlKey) {
            if ($url) {
                $url .= $this->configuration->$optionDelimiterMethod();
            }

            $url .= $optionUrlKey->url_key;
        }

        if ($urlKey->requires_param_name) {
            $url = $urlKey->url_key . $this->configuration->$valueDelimiterMethod() . $url;
        }

        unset($route->params['_query'][$urlKey->param_name]);
        $route->{$urlKey->url_part}[] = new RouterParameterData([
            'url' => $url,
            'position' => $urlKey->position,
            'id' => $urlKey->id,
        ]);

        return true;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $parameterUrlKey
     * @return UrlKeyData[]
     */
    protected function findOptionUrlKeys($route, $parameterUrlKey) {
        $paramName = $parameterUrlKey->param_name;
        $text = $route->params['_query'][$paramName];

        if ($this->helper->isPlaceholder($text, 0)) {
            return [new UrlKeyData(['url_key' => $text])];
        }

        $optionIds = explode($this->urlSettings->getMultipleValueSeparator(), $text);

        $result = [];
        foreach (array_keys($optionIds) as $optionKey) {
            $optionId = $optionIds[$optionKey];
            if ($urlKey = $this->findOptionUrlKeyInFacet($paramName, $optionId)) {
                $result[] = $urlKey;
                unset($optionIds[$optionKey]);
            }
        }

        if (count($optionIds)) {
            foreach ($this->resource->findOptions($optionIds, $route->store_id) as $data) {
                $result[] = new UrlKeyData($data);
            }
        }

        usort($result, function ($a, $b) {
            if ($a->position < $b->position) return -1;
            if ($a->position > $b->position) return 1;
            return 0;
        });

        return $result;
    }

    protected function findOptionUrlKeyInFacet($paramName, $optionId) {
        if (!$this->getEngine()->getLayer()) {
            return null;
        }

        if (!($facet = $this->getEngine()->getProductCollection()->getQuery()->getFacet($paramName))) {
            return null;
        }

        if (!($data = $facet->getData())) {
            return null;
        }

        if (isset($data['available_values'])) {
            // dropdown slider case - URL key info is not present in facet
            return null;
        }

        foreach ($data as $item) {
            if (!isset($item['value']) || $item['value'] != $optionId) {
                continue;
            }

            return new UrlKeyData([
                'url_key' => $item['url_key'],
                'position' => $item['url_position'],
            ]);
        }

        return null;
    }
}