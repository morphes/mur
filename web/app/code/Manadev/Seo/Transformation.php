<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo;

use Manadev\Seo\Data\RouteData;

abstract class Transformation
{
    /**
     * @param RouteData $route
     * @param mixed $value
     */
    abstract public function transform($route, &$value);
}