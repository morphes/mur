<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\LayeredNavigation\Engine;
use Manadev\LayeredNavigation\Helper;
use Manadev\LayeredNavigationSeo\Data\FilterData;
use Manadev\Seo\Content;
use Manadev\Seo\Data\RouteData;

class ContentPlugin
{
    /**
     * @var Engine
     */
    protected $engine;
    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Engine $engine, Helper $helper, Features $features) {
        $this->engine = $engine;
        $this->helper = $helper;
        $this->features = $features;
    }

    public function aroundIsApplicable($content, callable $proceed, $route) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($route);
        }

        if (!$proceed($route)) {
            return false;
        }

        return $this->engine->getLayer() != null;
    }

    public function aroundGetTemplate($content, callable $proceed, $type) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($type);
        }

        return "Manadev_LayeredNavigationSeo::$type.phtml";
    }

    public function aroundGetData($content, callable $proceed, $type) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($type);
        }

        $result = $proceed($type);
        $result['filters'] = [];

        $this->engine->getProductCollection()->loadFacets();
        foreach ($this->engine->getAppliedFilters() as $filter) {
            foreach ($filter->getAppliedItems() as $item) {
                $result['filters'][] = new FilterData([
                    'engine_filter' => $filter,

                    'filter' => $filter->getFilter(),
                    'filter_name' => $filter->getFilter()->getData('param_name'),
                    'filter_title' => $filter->getFilter()->getData('title'),

                    'item' => $item,
                    'item_label' => strip_tags($item['label']),
                    'included' => $filter->getFilter()->getData("include_in_$type") !== null
                        ? $filter->getFilter()->getData("include_in_$type")
                        : true
                ]);
            }
        }

        return $result;
    }

    /**
     * @param Content $content
     * @param callable $proceed
     * @param RouteData $route
     */
    public function aroundRemoveParametersFromCanonicalUrl($content, callable $proceed, $route) {
        $proceed($route);

        if (!$this->features->isEnabled(__CLASS__)) {
            return;
        }

        $filters = $this->helper->getAllFilters($route->store_id, $route->path)->getAllByParamName();

        foreach (array_keys($route->params['_query']) as $key) {
            if (!isset($filters[$key])) {
                continue;
            }

            if (!$filters[$key]->getData('include_in_canonical_url'))
            {
                unset($route->params['_query'][$key]);
            }
        }
    }
}