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
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\CategoryPageIndexer;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;

class CategoryPage extends UrlKeySubTypeHandler
{
    /**
     * @var CategoryPageIndexer
     */
    protected $indexer;

    public function __construct(CategoryPageIndexer $indexer) {
        $this->indexer = $indexer;
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
        return UrlKeyType::PAGE;
    }

    /**
     * @param int $storeId
     * @return ConflictScopeData[]
     */
    public function getConflictScopes($storeId) {
        return [
            'global' => new ConflictScopeData([
                'sort_order' => 100,
                'condition' => "`sub_type` = '" . $this->getSubType() . "'",
            ]),
        ];
    }

    /**
     * @see UrlKeySubType enum
     * @return string
     */
    public function getSubType() {
        return UrlKeySubType::CATEGORY_PAGE;
    }

    /**
     * @param UrlKeyData $urlKey
     * @return \string[]
     */
    public function getRouteParameters(UrlKeyData $urlKey) {
        return ['id' => $urlKey->category_id];
    }
}