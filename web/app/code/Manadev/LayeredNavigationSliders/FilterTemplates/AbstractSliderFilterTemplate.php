<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\FilterTemplates;

use Magento\Framework\Locale\CurrencyInterface;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\LayeredNavigation\Blocks\FilterRenderer;
use Manadev\LayeredNavigation\Configuration;
use Manadev\LayeredNavigation\Contracts\FilterTemplate;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigation\Helper;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigation\RequestParser;
use Manadev\ProductCollection\Factory;
use Manadev\ProductCollection\Contracts\ProductCollection;
use Manadev\ProductCollection\Query;

abstract class AbstractSliderFilterTemplate extends FilterTemplate
{
    /**
     * @var RequestParser
     */
    protected $requestParser;
    /**
     * @var Factory
     */
    protected $factory;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var CurrencyInterface
     */
    protected $localCurrency;
    /**
     * @var Helper
     */
    protected $layeredNavHelper;

    protected $navBlockPosition;
    protected $showRangeInputOnly = false;

    public function __construct(
        RequestParser $requestParser,
        Factory $factory,
        Configuration $configuration,
        StoreManagerInterface $storeManager,
        CurrencyInterface $localCurrency,
        Helper $layeredNavHelper
    ) {
        $this->layeredNavHelper = $layeredNavHelper;
        $this->requestParser = $requestParser;
        $this->factory = $factory;
        $this->configuration = $configuration;
        $this->storeManager = $storeManager;
        $this->localCurrency = $localCurrency;
    }

    /**
     * @param Filter $filter
     *
     * @return string
     */
    public function getFilename(Filter $filter) {
        return 'Manadev_LayeredNavigationSliders::filter/slider.phtml';
    }

    /**
     * @return string
     */
    public function getAppliedItemFilename() {
        return 'Manadev_LayeredNavigation::applied-item/standard.phtml';
    }

    /**
     * Registers filtering and counting logic with product collection
     *
     * @param ProductCollection $productCollection
     * @param Filter            $filter
     */
    public function prepare(ProductCollection $productCollection, Filter $filter) {
        $name = $filter->getData('param_name');
        $attributeId = $filter->getData('attribute_id');
        /** @var Query $query */
        $query = $productCollection->getQuery();

        if (($appliedRanges = $this->getAppliedRange($name)) !== false) {
            $query->getFilterGroup('layered_nav')->addOperand($this->createFilter($name, $attributeId, $appliedRanges));
        }

        $query->addFacet($this->createFacet($filter));
    }

    /**
     * @param string $values
     *
     * @return mixed|bool
     */
    public function getAppliedOptions($values) {
        return $this->implodeRanges($this->requestParser->readMultipleValueRangeString($values));
    }

    protected function implodeRanges($ranges) {
        if (!$ranges) {
            return false;
        }

        return array_map(function($range) { return implode('-', $range); }, $ranges);
    }

    /**
     * @param ProductCollection $productCollection
     * @param Filter            $filter
     *
     * @return array
     */
    public function getAppliedItems(ProductCollection $productCollection, Filter $filter) {
        $name = $filter->getData('param_name');
        $query = $productCollection->getQuery();

        if (!($facet = $query->getFacet($name))) {
            return;
        }

        $data = $facet->getData();
        if($data && $data['is_selected']) {
            yield $data;
        }
    }

    public function getLowerAppliedRange(Filter $filter) {
        $name = $filter->getData('param_name');
        $ranges = $this->getAppliedRange($name);
        $range = $ranges[0];

        return $range[0];
    }

    public function getUpperAppliedRange(Filter $filter) {
        $name = $filter->getData('param_name');

        $ranges = $this->getAppliedRange($name);
        $range = end($ranges);

        return $range[1];
    }

    public function isLabelHtmlEscaped() {
        return false;
    }

    public function getNumberFormat(Filter $filter, $prefix = "") {
        $number_format = $filter->getData($prefix.'number_format');
        if($number_format == "$0") {
            $store = $this->storeManager->getStore();
            $currency = $this->localCurrency->getCurrency($store->getCurrentCurrency()->getCode());
            $number_format = $currency->toCurrency(0, ['precision' => 0]);
        }

        return $number_format;
    }

    public function getAppliedFilterFormat() {
        return __("__0__ to __1__");
    }

    public function getMobileStyle() {
        return $this->configuration->getSliderStyleForMobile();
    }

    public function isShowRangeInputOnly() {
        if($this->isMobile() && $this->getMobileStyle() == "hide_slider") {
            return true;
        }

        return $this->showRangeInputOnly;
    }

    public function isSliderDisplayed() {
        return !$this->isShowRangeInputOnly();
    }

    /**
     * @param $name
     * @param $attributeId
     * @param $appliedRanges
     * @param $calculateSliderMinMax
     * @param $numberFormat
     *
     * @return mixed
     */
    protected function createFacet(Filter $filter) {
        $name = $filter->getData('param_name');
        $attributeId = $filter->getData('attribute_id');
        $calculateSliderMinMax = $filter->getData('calculate_slider_min_max_based_on');
        $numberFormat = $filter->getData('number_format');
        $showThousandSeparator = $filter->getData('show_thousand_separator');
        $appliedRanges = $this->getAppliedRange($name);
        $precision = $filter->getData("decimal_digits");

        return $this->factory->createSliderRangeDecimalFacet($name, $attributeId, $appliedRanges,
            $calculateSliderMinMax, $numberFormat, $showThousandSeparator, $precision);
    }

    /**
     * @param $name
     * @param $attributeId
     * @param $appliedRanges
     *
     * @return mixed
     */
    protected function createFilter($name, $attributeId, $appliedRanges) {
        return $this->factory->createLayeredDecimalFilter($name,$attributeId,$appliedRanges,true);
    }

    public function isSliderInlineInDropdown() {
        return $this->getNavBlockPosition() == "show_above_products" && $this->configuration->getIsSliderInlineInDropdownMenu();
    }

    public function isFilterShowRangeInput(Filter $filter) {
        if ($this->isMobile() && $this->getMobileStyle() == "hide_slider") {
            return true;
        }

        return (bool)$filter->getData('is_manual_range') || $this->isShowRangeInputOnly();
    }

    public function getRangeClass(Filter $filter) {
        $rangeClass = "";
        if ($this->isShowRangeInputOnly()) {
            $rangeClass = "mana-slider-range-only";
        } elseif ($this->isFilterShowRangeInput($filter)) {
            $rangeClass = "mana-slider-with-range";
        }

        return $rangeClass;
    }

    public function getSliderStyle(Filter $filter){
        $mobileStyle = $this->getMobileStyle();

        if($this->isMobile() && $mobileStyle != "same_as_desktop") {
            return $mobileStyle;
        }

        return $filter->getData('slider_style');
    }

    public function isMobile() {
        return $this->getNavBlockPosition() == "show_on_mobile";
    }

    public function setNavBlockPosition($position) {
        $this->navBlockPosition = $position;
    }

    public function getNavBlockPosition() {
        return $this->navBlockPosition;
    }

    public function getScriptConfig($sliderData, Filter $filter, FilterRenderer $block, EngineFilter $engineFilter) {
        $config = [
            'paramName' => $filter->getData('param_name'),
            'showRangeInput' => $this->isFilterShowRangeInput($filter),
            'appliedFormat' => $this->getAppliedFilterFormat(),
            'applyFilterURL' => $block->getRangeSliderApplyUrl($engineFilter),
            'clearFilterURL' => $block->getRemoveItemUrl($engineFilter),
            'isInitLate' => $this->isSliderDisplayed(),
            'isDropdownInline' => $this->isSliderInlineInDropdown(),
            'numberFormat' => $this->getNumberFormat($filter),
            'showThousandSeparator' => (bool)$filter->getData('show_thousand_separator'),
            'decimalDigits' => $filter->getData('decimal_digits'),
            'range' => [floatval($sliderData['min_range']), floatval($sliderData['max_range'])],
        ];

        if($filter->getData('is_slide_on_existing_values')) {
            $config['allowedValues'] = $sliderData['available_values'];
        }

        if ($engineFilter->isApplied()) {
            $lowerAppliedRange = $this->getLowerAppliedRange($filter) ?: $sliderData['min_range'];
            $upperAppliedRange = $this->getUpperAppliedRange($filter) ?: $sliderData['max_range'];
            $config['appliedRange'] = [floatval($lowerAppliedRange), floatval($upperAppliedRange)];
        }
        if ($filter->getData('is_two_number_formats')) {
            $config['secondNumberFormat'] = $this->getNumberFormat($filter, "second_");
            $config['useSecondNumberFormatOn'] = $filter->getData('use_second_number_format_on');
            $config['secondFormatDecimalDigits'] = $filter->getData('second_decimal_digits');
        }

        return $config;
    }

    /**
     * @param $name
     *
     * @return array|bool
     */
    protected function getAppliedRange($name) {
        return $this->requestParser->readMultipleValueRange($name);
    }

    public function isSlider() {
        return true;
    }
}