<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Facets\Decimal;

class MinMaxSliderRangeFacet extends AbstractSliderFacet
{
    /**
     * @var
     */
    protected $minMaxRole;
    /**
     * @var
     */
    protected $minAttributeCode;
    /**
     * @var null
     */
    protected $maxFilterId;

    public function __construct(
        $name, $attributeId, $appliedRanges, $calculateSliderMinMax, 
        $numberFormat, $showThousandSeparator, $minMaxRole,
        $minAttributeCode, $precision, $maxFilterId = null
    ) {
        $this->minMaxRole = $minMaxRole;
        $this->minAttributeCode = $minAttributeCode;
        $this->maxFilterId = $maxFilterId;
        parent::__construct($name, $attributeId, $appliedRanges, $calculateSliderMinMax, $numberFormat, $showThousandSeparator,
            $precision);
    }

    public function getType() {
        return 'decimal_min_max_slider_range';
    }

    /**
     * @return mixed
     */
    public function getMinAttributeCode() {
        return $this->minAttributeCode;
    }

    /**
     * @return mixed
     */
    public function getMinMaxRole() {
        return $this->minMaxRole;
    }

    /**
     * @return null
     */
    public function getMaxFilterId() {
        return $this->maxFilterId;
    }
}