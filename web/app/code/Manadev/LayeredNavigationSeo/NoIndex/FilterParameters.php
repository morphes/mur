<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\NoIndex;

use Manadev\LayeredNavigation\Helper;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigation\Registries\FilterTypes;
use Manadev\LayeredNavigationSeo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Transformation;

class FilterParameters extends Transformation
{
    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var FilterTypes
     */
    protected $filterTypes;
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Helper $helper, FilterTypes $filterTypes, Configuration $configuration) {
        $this->helper = $helper;
        $this->filterTypes = $filterTypes;
        $this->configuration = $configuration;
    }

    /**
     * @param RouteData $route
     * @param mixed $value
     */
    public function transform($route, &$value) {
        if ($value == 'NOINDEX') {
            return;
        }

        if (!isset($route->params['_query'])) {
            return;
        }

        $excludeSliders = $this->configuration->areSlidersNotIndexed($route->store_id);
        $maxFilters = $this->configuration->getMaxIndexedFilters($route->store_id);
        $countFilters = $this->configuration->areIndexedFiltersCounted($route->store_id);
        $count = 0;

        $filters = $this->helper->getAllFilters($route->store_id, $route->path)->getAllByParamName();

        foreach ($route->params['_query'] as $key => $values) {
            if (!isset($filters[$key])) {
                continue;
            }

            $filter = $filters[$key];

            if (!($filterType = $this->filterTypes->get($filter->getData('type')))) {
                continue;
            }

            if (!($template = $filterType->getTemplates()->get($filter->getData('template')))) {
                continue;
            }

            if ($countFilters) {
                $count++;
            }
            else {
                $options = $template->getAppliedOptions($values);
                $count += $options === false ? 0 : count($options);
            }

            if ($maxFilters && $count >= $maxFilters) {
                $value = 'NOINDEX';
                return;
            }

            if ($filter->getData('force_no_index')) {
                $value = 'NOINDEX';
                return;
            }

            if ($excludeSliders) {
                if ($template->isSlider()) {
                    $value = 'NOINDEX';
                    return;
                }
            }
        }
    }
}