<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Generation;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Profiler;
use Manadev\Core\QueryLogger;
use Manadev\Core\Registries\PageTypes;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\RouterParameterData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\QueryPart;
use Manadev\Seo\Registries\UrlKeySubTypes;
use Manadev\Seo\Resources\UrlKeyResource;
use Magento\Framework\App\Request\Http as Request;

class UrlGenerator
{
    protected $lastRoute;
    protected $lastOriginalRoute;

    /**
     * @var UrlKeyData[]
     */
    protected $parameterUrlKeys = [];

    /**
     * @var string[]
     */
    protected $excludedQueryParameters;

    /**
     * @var PageTypes
     */
    protected $pageTypes;
    /**
     * @var UrlKeyResource
     */
    protected $resource;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var UrlKeySubTypes
     */
    protected $urlKeySubTypes;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var QueryLogger
     */
    protected $queryLogger;
    /**
     * @var Profiler
     */
    protected $profiler;
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    public function __construct(ObjectManagerInterface $objectManager, PageTypes $pageTypes,
        UrlKeyResource $resource, StoreManagerInterface $storeManager,
        Configuration $configuration, RequestInterface $request,
        QueryLogger $queryLogger, Profiler $profiler)
    {
        $this->pageTypes = $pageTypes;
        $this->resource = $resource;
        $this->storeManager = $storeManager;
        $this->configuration = $configuration;
        $this->request = $request;
        $this->queryLogger = $queryLogger;
        $this->profiler = $profiler;
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $path
     * @param array|null $params
     * @return RouteData
     */
    public function generate($path, $params) {
        $this->profiler->start('seo-url-generator');
        if ($this->configuration->isGeneratorLoggingEnabled()) {
            $this->queryLogger->begin('seo-url-generator');
        }

        try {
            return $this->doGenerate($path, $params);
        }
        finally {
            if ($this->configuration->isGeneratorLoggingEnabled()) {
                $this->queryLogger->end('seo-url-generator');
            }
            $this->profiler->stop('seo-url-generator');
        }
    }

    /**
     * @param string $path
     * @param array|null $params
     * @return RouteData
     */
    protected function doGenerate($path, $params) {
        $this->lastRoute = null;
        $this->lastOriginalRoute = null;
        if (!$path || !is_array($params) || isset($params['_direct'])) {
            return null;
        }

        if (isset($params['_store'])) {
            $storeId = $params['_store'];
            unset($params['_store']);
        }
        else {
            $storeId = $this->storeManager->getStore()->getId();
        }

        $route = new RouteData([
            'path' => $path,
            'params' => $params,
            'store_id' => $storeId,
            'prefix' => [],
            'suffix' => [],
        ]);

        $this->expandAsterisks($route);
        $this->expandCurrentQuery($route);

        $this->lastRoute = $route;
        $this->lastOriginalRoute = clone $route;

        if (!$this->generatePageUrl($route)) {
            return null;
        }

        if (isset($route->params['_query'])) {
            foreach (array_keys($route->params['_query']) as $name) {
                if (is_null($route->params['_query'][$name])) {
                    unset($route->params['_query'][$name]);
                    continue;
                }

                if (in_array($name, $this->getExcludedQueryParameters())) {
                    unset($route->params['_query'][$name]);
                    continue;
                }


                $this->generateUrlParameter($route, $name);
            }
        }

        $this->assignDirectUrl($route);

        return $route;
    }

    /**
     * @param RouteData $route
     * @return bool
     */
    protected function generatePageUrl($route) {
        if (!($pageType = $this->pageTypes->get($route->path))) {
            return false;
        }

        $route->extension = $pageType->getUrlExtension();
        if ($route->extension && $route->extension != '/' && mb_strpos($route->extension, '.') !== 0) {
            $route->extension = '.' . $route->extension;
        }

        if ($route->path == 'cms/index/index') {
            return true;
        }

        if (!($pageCondition = $pageType->getUrlKeySearchCondition($route))) {
            return false;
        }

        if (!($route->page_url_key = $this->resource->findPage($pageCondition, $route->store_id))) {
            return false;
        }

        return true;
    }

    /**
     * @param RouteData $route
     * @param string $name
     * @return bool
     */
    protected function generateUrlParameter($route, $name) {
        if (!($urlKey = $this->findParameterUrlKey($route, $name))) {
            return false;
        }

        if ($urlKey->url_part == QueryPart::QUERY) {
            return true;
        }

        if (!($subType = $this->getUrlKeySubTypes()->get($urlKey->sub_type))) {
            return false;
        }

        return $subType->generateParameterUrl($route, $urlKey);
    }

    /**
     * @return array
     */
    protected function getExcludedQueryParameters() {
        if (!$this->excludedQueryParameters) {
            $this->excludedQueryParameters = $this->configuration->getExcludedQueryParameters();
        }

        return $this->excludedQueryParameters;
    }

    /**
     * @param RouteData $route
     * @param $name
     * @return UrlKeyData
     */
    protected function findParameterUrlKey($route, $name) {
        if (!isset($this->parameterUrlKeys[$route->store_id])) {
            $this->parameterUrlKeys[$route->store_id] = [];

            foreach ($this->resource->findParameters($route->store_id) as $data) {
                $this->parameterUrlKeys[$route->store_id][$data['param_name']] = new UrlKeyData($data);
            }
        }

        if (!isset($this->parameterUrlKeys[$route->store_id][$name])) {
            return null;
        }

        return $this->parameterUrlKeys[$route->store_id][$name];
    }

    /**
     * @param RouteData $route
     */
    protected function assignDirectUrl($route) {
        $url = $this->generatePart('prefix', $route);

        if ($route->page_url_key) {
            $url = $url
                ? $url . $this->configuration->getPrefixDelimiter() . $route->page_url_key
                : $route->page_url_key;
            $delimiter = $this->configuration->getSuffixDelimiter();
        }
        else {
            $delimiter = $this->configuration->getPrefixDelimiter();
        }

        if ($suffix = $this->generatePart('suffix', $route)) {
            if ($url) {
                $url .= $delimiter;
            }
            $url .= $suffix;
        }

        if ($url) {
            $url .= $route->extension;
        }

        $route->params['_direct'] = $url;
    }

    /**
     * @param string $part
     * @param RouteData $route
     * @return string
     */
    protected function generatePart($part, $route) {
        $result = '';
        $parameterDelimiterMethod = "get" . ucfirst($part) . "ParameterDelimiter";
        $delimiter = $this->configuration->$parameterDelimiterMethod();

        usort($route->{$part}, function($a, $b) {
            if ($a->position < $b->position) return -1;
            if ($a->position > $b->position) return 1;

            if ($a->id < $b->id) return -1;
            if ($a->id > $b->id) return 1;

            return 0;
        });

        foreach ($route->{$part} as $parameter) {
            /* @var RouterParameterData $parameter */

            if ($result) {
                $result .= $delimiter;
            }

            $result .= $parameter->url;
        }

        return $result;
    }

    /**
     * @param RouteData $route
     */
    protected function expandAsterisks($route) {
        $routePieces = explode('/', $route->path);

        $path = array_shift($routePieces);
        if ('*' === $path) {
            $path = $this->request->getRouteName();
        }

        $controller = '';
        if (!empty($routePieces)) {
            $controller = array_shift($routePieces);
            if ('*' === $controller) {
                $controller = $this->request->getControllerName();
            }
        }
        if ($controller) {
            $path .= '/' . $controller;
        }

        $action = '';
        if (!empty($routePieces)) {
            $action = array_shift($routePieces);
            if ('*' === $action) {
                $action = $this->request->getActionName();
            }
        }
        if ($action) {
            $path .= '/' . $action;
        }

        if (!empty($routePieces)) {
            while (!empty($routePieces)) {
                $key = array_shift($routePieces);
                if (!empty($routePieces)) {
                    $value = array_shift($routePieces);
                    $route->params[$key] = $value;
                }
            }
        }

        $route->path = $path;
    }

    /**
     * @param RouteData $route
     */
    protected function expandCurrentQuery($route) {
        $data = $route->params;
        if (!isset($data['_current'])) {
            return;
        }

        if (is_array($data['_current'])) {
            foreach ($data['_current'] as $key) {
                if (array_key_exists($key, $data) || !$this->request->getUserParam($key)) {
                    continue;
                }
                $data[$key] = $this->request->getUserParam($key);
            }
        } elseif ($data['_current']) {
            foreach ($this->request->getUserParams() as $key => $value) {
                if (array_key_exists($key, $data)) {
                    continue;
                }
                $data[$key] = $value;
            }

            $query = empty($data['_query']) ? [] :$data['_query'];
            $data['_query'] = array_merge($this->request->getQuery()->toArray(), $query);
        }
        unset($data['_current']);
        $route->params = $data;

    }

    /**
     * @return RouteData
     */
    public function getLastRoute() {
        return $this->lastRoute;
    }

    /**
     * @return RouteData
     */
    public function getLastOriginalRoute() {
        return $this->lastOriginalRoute;
    }

    /**
     * Circular dependency fix
     */
    protected function getUrlKeySubTypes() {
        if (!$this->urlKeySubTypes) {
            $this->urlKeySubTypes = $this->objectManager->get(UrlKeySubTypes::class);
        }

        return $this->urlKeySubTypes;
    }
}