<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\UrlKeySubTypes;

use Manadev\Seo\Data\ConflictScopeData;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Generation\ToolbarParameterGenerator;
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Parsing\ToolbarParameterParser;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\ToolbarParameterIndexer;

class ToolbarParameter extends UrlKeySubTypeHandler
{
    /**
     * @var ToolbarParameterIndexer
     */
    protected $indexer;
    /**
     * @var ToolbarParameterParser
     */
    protected $parser;
    /**
     * @var ToolbarParameterGenerator
     */
    protected $urlGenerator;

    public function __construct(ToolbarParameterIndexer $indexer, ToolbarParameterParser $parser,
        ToolbarParameterGenerator $urlGenerator)
    {
        $this->indexer = $indexer;
        $this->parser = $parser;
        $this->urlGenerator = $urlGenerator;
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
        return UrlKeySubType::TOOLBAR_PARAMETER;
    }

    /**
     * @return ParameterParser
     */
    public function getParameterParser() {
        return $this->parser;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $urlKey
     * @return bool
     */
    public function generateParameterUrl($route, $urlKey) {
        return $this->urlGenerator->generate($route, $urlKey);
    }
}