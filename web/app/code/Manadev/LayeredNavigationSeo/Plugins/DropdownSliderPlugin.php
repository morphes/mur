<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Magento\Store\Model\StoreManagerInterface;
use Manadev\LayeredNavigation\Blocks\FilterRenderer;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\Seo\Configuration;
use Manadev\Seo\Enums\QueryPart;
use Manadev\Seo\Resources\UrlKeyResource;

class DropdownSliderPlugin
{
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var UrlKeyResource
     */
    protected $resource;

    public function __construct(Configuration $configuration,
        StoreManagerInterface $storeManager, UrlKeyResource $resource)
    {
        $this->configuration = $configuration;
        $this->storeManager = $storeManager;
        $this->resource = $resource;
    }

    public function aroundGetScriptConfig($subject, callable $proceed, $sliderData,
        Filter $filter, FilterRenderer $block, EngineFilter $engineFilter)
    {
        $result = $proceed($sliderData, $filter, $block, $engineFilter);

        if (($urlPart = $engineFilter->getFilter()->getData('url_part')) == QueryPart::QUERY) {
            return $result;
        }

        $optionDelimiterMethod = "get" . ucfirst($urlPart) . "OptionDelimiter";

        $result['valueDelimiter'] = $this->configuration->$optionDelimiterMethod();
        $result['allowedValueUrlKeys'] = $this->resource->findOptions($result['allowedValuesId'],
            $this->storeManager->getStore()->getId());

        return $result;
    }
}