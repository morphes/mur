<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Generation;

use Manadev\Core\Registries\PageTypes;
use Manadev\LayeredNavigation\UrlSettings;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\RouterParameterData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Resources\UrlKeyResource;

class CategoryFilterParameterGenerator
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
     * @var UrlKeyResource
     */
    protected $resource;
    /**
     * @var PageTypes
     */
    protected $pageTypes;

    public function __construct(Configuration $configuration, UrlSettings $urlSettings, UrlKeyResource $resource,
        PageTypes $pageTypes)
    {
        $this->configuration = $configuration;
        $this->urlSettings = $urlSettings;
        $this->resource = $resource;
        $this->pageTypes = $pageTypes;
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

        foreach ($this->findCategoryUrlKeys($route, $urlKey) as $categoryUrlKey) {
            if ($url) {
                $url .= $this->configuration->$optionDelimiterMethod();
            }

            $url .= $categoryUrlKey->url_key;
        }

        $url = $urlKey->url_key . $this->configuration->$valueDelimiterMethod() . $url;

        unset($route->params['_query'][$urlKey->param_name]);
        $route->{$urlKey->url_part}[] = new RouterParameterData([
            'url' => $url,
            'position' => $urlKey->position,
        ]);

        return true;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $parameterUrlKey
     * @return UrlKeyData[]
     */
    protected function findCategoryUrlKeys($route, $parameterUrlKey) {
        $result = [];
        $paramName = $parameterUrlKey->param_name;
        $categoryIds = explode($this->urlSettings->getMultipleValueSeparator(), $route->params['_query'][$paramName]);

        if (count($categoryIds)) {
            foreach ($this->resource->findCategory($categoryIds, $route->store_id) as $data) {
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

    /**
     * @param RouteData $route
     * @param UrlKeyData $parameterUrlKey
     * @return bool
     */
    public function redirectToSubcategory($route, $parameterUrlKey) {
        if (!$this->configuration->isCategoryFilterRedirectedToSubcategoryPage()) {
            return false;
        }

        if ($route->path != 'catalog/category/view' && $route->path != 'cms/index/index') {
            return false;
        }

        $value = $route->params['_query'][$parameterUrlKey->param_name];
        if (mb_strpos($value, $this->urlSettings->getMultipleValueSeparator()) !== false) {
            return false;
        }

        $route->path = 'catalog/category/view';
        $route->params['id'] = $value;
        $route->params['_query'][$parameterUrlKey->param_name] = null;

        $pageType = $this->pageTypes->get($route->path);

        $route->extension = $pageType->getUrlExtension();
        if ($route->extension && $route->extension != '/' && mb_strpos($route->extension, '.') !== 0) {
            $route->extension = '.' . $route->extension;
        }

        $pageCondition = $pageType->getUrlKeySearchCondition($route);
        $route->page_url_key = $this->resource->findPage($pageCondition, $route->store_id);

        return true;
    }
}