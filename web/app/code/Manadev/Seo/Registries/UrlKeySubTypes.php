<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Registries;

use Manadev\Core\Exceptions\InterfaceNotImplemented;
use Manadev\Core\Features;
use Manadev\Seo\UrlKeySubTypes\UrlKeySubTypeHandler;

class UrlKeySubTypes
{
    /**
     * @var UrlKeySubTypeHandler[]
     */
    protected $urlKeySubTypes;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Features $features, array $urlKeySubTypes)
    {
        $this->features = $features;

        foreach (array_keys($urlKeySubTypes) as $key) {
            $urlKeySubType = $urlKeySubTypes[$key];

            if (!$this->features->isEnabled(get_class($urlKeySubType), 0)) {
                unset($urlKeySubTypes[$key]);
                continue;
            }

            if (!($urlKeySubType instanceof UrlKeySubTypeHandler)) {
                throw new InterfaceNotImplemented(sprintf("'%s' does not implement '%s' interface.",
                    get_class($urlKeySubType), UrlKeySubTypeHandler::class));
            }
        }
        $this->urlKeySubTypes = $urlKeySubTypes;
    }

    /**
     * @param $subType
     * @return UrlKeySubTypeHandler
     */
    public function get($subType) {
        return isset($this->urlKeySubTypes[$subType]) ? $this->urlKeySubTypes[$subType] : null;
    }

    public function getList() {
        return $this->urlKeySubTypes;
    }
}