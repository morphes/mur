<?php

namespace Manadev\LayeredNavigationSliders\Filters;

use Manadev\ProductCollection\Enums\Operation;
use Manadev\ProductCollection\Filters\LayeredFilters\DecimalFilter;

class MinMaxFilter extends DecimalFilter
{
    /**
     * @var
     */
    protected $maxAttributeId;

    public function __construct($name, $attributeId, $maxAttributeId, $ranges,
        $isToRangeInclusive = false, $operation = Operation::LOGICAL_OR)
    {
        parent::__construct($name, $attributeId, $ranges, $isToRangeInclusive, $operation);
        $this->maxAttributeId = $maxAttributeId;
    }

    /**
     * @return mixed
     */
    public function getMaxAttributeId() {
        return $this->maxAttributeId;
    }

    public function getType() {
        return 'layered_min_max';
    }
}