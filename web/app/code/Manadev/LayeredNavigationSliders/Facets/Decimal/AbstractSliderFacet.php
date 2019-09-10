<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Facets\Decimal;

use Manadev\ProductCollection\Facets\Price\BaseFacet;

abstract class AbstractSliderFacet extends BaseFacet
{
    protected $minRange = null;
    protected $maxRange = null;
    protected $availableValues;
    /**
     * @var
     */
    protected $calculateSliderMinMax;
    /**
     * @var
     */
    protected $numberFormat;
    /**
     * @var bool
     */
    protected $showThousandSeparator;
    /**
     * @var
     */
    protected $attributeId;
    /**
     * @var
     */
    protected $precision;

    public function __construct($name, $attributeId, $appliedRanges, $calculateSliderMinMax, $numberFormat,
        $showThousandSeparator, $precision)
    {
        $this->calculateSliderMinMax = $calculateSliderMinMax;
        $this->numberFormat = $numberFormat;
        $this->showThousandSeparator = $showThousandSeparator;
        $this->attributeId = $attributeId;
        parent::__construct($name, $appliedRanges);
        $this->precision = $precision;
    }

    public function setMaxRange($maxRange) {
        $this->maxRange = $maxRange;
    }

    public function setMinRange($minRange) {
        $this->minRange = $minRange;
    }

    /**
     * @return mixed
     */
    public function getMaxRange() {
        return $this->maxRange;
    }

    /**
     * @return mixed
     */
    public function getMinRange() {
        return $this->minRange;
    }

    /**
     * @return mixed
     */
    public function getAvailableValues() {
        return $this->availableValues;
    }

    /**
     * @param array $availableValues
     */
    public function setAvailableValues(array $availableValues) {
        $this->availableValues = $availableValues;
    }

    /**
     * @return mixed
     */
    public function getCalculateSliderMinMax() {
        return $this->calculateSliderMinMax;
    }

    /**
     * @return mixed
     */
    public function getNumberFormat() {
        return $this->numberFormat;
    }

    /**
     * @return boolean
     */
    public function isShowThousandSeparator() {
        return $this->showThousandSeparator;
    }

    /**
     * @return mixed
     */
    public function getAttributeId() {
        return $this->attributeId;
    }

    public function getPrecision() {
        return $this->precision;
    }
}