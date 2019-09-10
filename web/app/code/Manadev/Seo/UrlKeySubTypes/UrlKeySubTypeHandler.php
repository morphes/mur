<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\UrlKeySubTypes;

use Manadev\Seo\Data\ConflictScopeData;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Resources\SeoUrlKeyIndexers\SeoUrlKeyIndexer;

abstract class UrlKeySubTypeHandler
{
    /**
     * @return SeoUrlKeyIndexer
     */
    abstract public function getIndexer();

    /**
     * @see UrlKeyType
     * @return string
     */
    abstract public function getType();

    /**
     * @see UrlKeySubType enum
     * @return string
     */
    abstract public function getSubType();

    /**
     * @param int $storeId
     * @return ConflictScopeData[]
     */
    abstract public function getConflictScopes($storeId);

    /**
     * @return bool
     */
    public function canHaveMultipleKeys() {
        return false;
    }

    /**
     * @param UrlKeyData $urlKey
     * @return \string[]
     */
    public function getRouteParameters(UrlKeyData $urlKey) {
        return [];
    }

    /**
     * @return ParameterParser
     */
    public function getParameterParser() {
        return null;
    }

    /**
     * @param RouteData $route
     * @param UrlKeyData $urlKey
     * @return bool
     */
    public function generateParameterUrl($route, $urlKey) {
        return false;
    }

    public function allowsPositionalParameterValues() {
        return false;
    }
}