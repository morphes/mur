<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\NoFollow;

use Manadev\Seo\Configuration;
use Manadev\Seo\Data\RouteData;
use Manadev\Seo\Transformation;

class ToolbarParameters extends Transformation
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
        if ($value == 'NOFOLLOW') {
            return;
        }

        if (!isset($route->params['_query'])) {
            return;
        }

        foreach ($this->configuration->getToolbarParameters() as $parameter => $configKey) {
            if (!isset($route->params['_query'][$parameter])) {
                continue;
            }

            if (!$this->configuration->isToolbarParameterNotFollowed($configKey, $route->store_id)) {
                continue;
            }

            $value = 'NOFOLLOW';
            return;
        }
    }
}