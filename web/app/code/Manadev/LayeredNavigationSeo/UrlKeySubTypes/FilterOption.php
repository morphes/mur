<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\UrlKeySubTypes;

use Manadev\LayeredNavigationSeo\Resources\SeoUrlKeyIndexers\FilterOptionIndexer;
use Manadev\Seo\Data\ConflictScopeData;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;
use Manadev\Seo\UrlKeySubTypes\UrlKeySubTypeHandler;

class FilterOption extends UrlKeySubTypeHandler
{
    /**
     * @var FilterOptionIndexer
     */
    protected $indexer;

    public function __construct(FilterOptionIndexer $indexer) {
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
        return UrlKeyType::OPTION;
    }

    /**
     * @param int $storeId
     * @return ConflictScopeData[]
     */
    public function getConflictScopes($storeId) {
        $result = [
            'global' => new ConflictScopeData([
                'sort_order' => 100,
                'condition' => "`sub_type` = '" . $this->getSubType() . "' AND " .
                    "`requires_param_name` = 0",
            ]),
        ];

        foreach ($this->indexer->getFilterParamNames($storeId) as $paramName) {
            $result[$paramName . '_options'] = new ConflictScopeData([
                'sort_order' => 300,
                'condition' => "`sub_type` = '" . $this->getSubType() . "' AND " .
                    "`requires_param_name` = 1 AND " .
                    "`param_name` = '$paramName'",
            ]);
        }

        return $result;
    }

    /**
     * @see UrlKeySubType enum
     * @return string
     */
    public function getSubType() {
        return UrlKeySubType::FILTER_OPTION;
    }

    /**
     * @return bool
     */
    public function canHaveMultipleKeys() {
        return true;
    }
}