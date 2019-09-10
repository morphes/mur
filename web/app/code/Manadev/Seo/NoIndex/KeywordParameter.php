<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\NoIndex;

use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Transformation;

class KeywordParameter extends Transformation
{
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Configuration $configuration) {
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

        if (!isset($route->params['_query']['q'])) {
            return;
        }

        if (!$this->configuration->isKeywordParameterNotIndexed($route->store_id)) {
            return;
        }

        $value = 'NOINDEX';
    }
}