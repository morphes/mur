<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\UrlKeySubTypes;

use Manadev\LayeredNavigationSeo\Generation\RangeFilterParameterGenerator;
use Manadev\LayeredNavigationSeo\Parsing\RangeFilterParameterParser;
use Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers\RangeFilterParameterIndexer;
use Manadev\Seo\Data\ConflictScopeData;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;
use Manadev\Seo\UrlKeySubTypes\UrlKeySubTypeHandler;

class RangeFilterParameter extends UrlKeySubTypeHandler
{
    /**
     * @var RangeFilterParameterIndexer
     */
    protected $indexer;
    /**
     * @var RangeFilterParameterGenerator
     */
    protected $urlGenerator;
    /**
     * @var RangeFilterParameterParser
     */
    protected $parser;

    public function __construct(RangeFilterParameterIndexer $indexer, RangeFilterParameterGenerator $urlGenerator,
        RangeFilterParameterParser $parser)
    {
        $this->indexer = $indexer;
        $this->urlGenerator = $urlGenerator;
        $this->parser = $parser;
    }

    /**
     * @return SeoUrlKeyIndexer
     */
    public function getIndexer() {
        return $this->indexer;
    }

    /**
     * @return string|UrlKeyType
     */
    public function getType() {
        return UrlKeyType::PARAMETER;
    }

    /**
     * @param int $storeId
     * @return ConflictScopeData[]
     */
    public function getConflictScopes($storeId) {
        return [
            'parameter' => new ConflictScopeData([
                'sort_order' => 200,
                'condition' => "`sub_type` = '" . $this->getSubType() . "'",
            ]),
        ];
    }

    /**
     * @see UrlKeySubType enum
     * @return string
     */
    public function getSubType() {
        return UrlKeySubType::RANGE_FILTER_PARAMETER;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $urlKey
     * @return bool
     */
    public function generateParameterUrl($route, $urlKey) {
        return $this->urlGenerator->generate($route, $urlKey);
    }

    /**
     * @return ParameterParser
     */
    public function getParameterParser() {
        return $this->parser;
    }

}