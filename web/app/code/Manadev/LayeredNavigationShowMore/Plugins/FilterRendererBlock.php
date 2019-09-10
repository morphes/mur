<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationShowMore\Plugins;

use Closure;
use Manadev\Core\Features;
use Manadev\LayeredNavigation\Blocks\FilterRenderer;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigationShowMore\Configuration;
use Manadev\LayeredNavigationShowMore\Sources\MethodOfShowingItems;
use Manadev\ProductCollection\Contracts\Facet;

class FilterRendererBlock
{
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Configuration $configuration, Features $features) {
        $this->configuration = $configuration;
        $this->features = $features;
    }

    public function aroundRender(FilterRenderer $filterRenderer, Closure $proceed, EngineFilter $engineFilter){
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed($engineFilter);
        }

        $filter = $engineFilter->getFilter();
        $facet = $engineFilter->getFacet();

        if(! $engineFilter->getFilterTemplate()->isShowMoreApplicable() || ! $facet ||
            count($facet->getData()) <= intval($filter->getData('show_more_item_limit')))
        {
            // If the filter's template does not use show more, carry on.
            // Filters with no available options will be skipped as well.
            return $proceed($engineFilter);
        }

        if($this->isPopup($filter)) {
            /** @var Facet $facet */
            // If it's a popup, remove the excess record. It will be displayed on a popup window.
            $this->removeHiddenRecordsOnFacet($facet, $filter->getData('show_more_item_limit'));
        }

        $result = $proceed($engineFilter);

        // Add actions block
        // The action block will determine if `Show More` needs to be displayed
        //     -- `Show More` will be displayed if it's not a scroll bar.
        // The action block will also modify the filter element directly using javascript
        // The action block needs to know the filter element selector, number of records, and its type (scrollbar or not)
        $data = [
            'show_more' => $filter->getData('show_more_method') != MethodOfShowingItems::SCROLLBAR,
            'show_option_search' => $filter->getData('show_option_search'),
            'filter_selector' => "#" . $filterRenderer->getFilterName($filter),
            'show_more_method' => $filter->getData('show_more_method'),
            'js_options' => [
                'number_of_visible_items' => $filter->getData('show_more_item_limit'),
                'show_more_label' => __("Show more"),
                'show_less_label' => __("Show less"),
                'transition_duration_ms' => $this->configuration->getEffectDuration(),
            ],
            'content' => $result,
        ];

        return $filterRenderer->getLayout()
            ->createBlock(
                \Manadev\LayeredNavigationShowMore\Blocks\ShowMore::class,
                null,
                ['data' => $data]
            )->toHtml();
    }

    protected function isPopup(Filter $filter) {
        return $filter->getData('show_more_method') == MethodOfShowingItems::POPUP;
    }

    protected function removeHiddenRecordsOnFacet(Facet $facet, $item_limit) {
        $data = $facet->getData();
        $slicedData = array_slice($data, 0, $item_limit);
        $facet->setData($data);

        return $slicedData;
    }
}