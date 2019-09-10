<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\UrlKeySubTypes;

use Manadev\LayeredNavigationSeo\Generation\CategoryFilterParameterGenerator;
use Manadev\LayeredNavigationSeo\Parsing\CategoryFilterParameterParser;
use Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers\CategoryFilterParameterIndexer;
use Manadev\Seo\Data\ConflictScopeData;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;
use Manadev\Seo\UrlKeySubTypes\UrlKeySubTypeHandler;

class CategoryFilterParameter extends UrlKeySubTypeHandler
{
    /**
     * @var CategoryFilterParameterIndexer
     */
    protected $indexer;
    /**
     * @var CategoryFilterParameterGenerator
     */
    protected $urlGenerator;
    /**
     * @var CategoryFilterParameterParser
     */
    protected $parser;

    public function __construct(CategoryFilterParameterIndexer $indexer,
        CategoryFilterParameterGenerator $urlGenerator, CategoryFilterParameterParser $parser)
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
        return UrlKeySubType::CATEGORY_FILTER_PARAMETER;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $urlKey
     * @return bool
     */
    public function generateParameterUrl($route, $urlKey) {
        return $this->urlGenerator->redirectToSubcategory($route, $urlKey) ||
            $this->urlGenerator->generate($route, $urlKey);
    }

    /**
     * @return ParameterParser
     */
    public function getParameterParser() {
        return $this->parser;
    }
}