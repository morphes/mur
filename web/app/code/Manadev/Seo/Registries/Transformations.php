<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Registries;

use Manadev\Core\Exceptions\InterfaceNotImplemented;
use Manadev\Core\Features;
use Manadev\Seo\Transformation;

abstract class Transformations
{
    /**
     * @var Transformation[]
     */
    protected $urlKeySubTypes;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Features $features, array $transformations)
    {
        $this->features = $features;

        foreach (array_keys($transformations) as $key) {
            $transformation = $transformations[$key];

            if (!$this->features->isEnabled(get_class($transformation))) {
                unset($transformations[$key]);
                continue;
            }

            if (!($transformation instanceof Transformation)) {
                throw new InterfaceNotImplemented(sprintf("'%s' does not implement '%s' interface.",
                    get_class($transformation), Transformation::class));
            }
        }
        $this->urlKeySubTypes = $transformations;
    }

    /**
     * @param $subType
     * @return Transformation
     */
    public function get($subType) {
        return isset($this->urlKeySubTypes[$subType]) ? $this->urlKeySubTypes[$subType] : null;
    }

    public function getList() {
        return $this->urlKeySubTypes;
    }
}