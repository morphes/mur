<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Plugins;

use Manadev\Core\Forms\Form;
use Manadev\Core\Sources\YesNoSource;
use Manadev\LayeredNavigationSliders\Sources\MinAttributeSource;
use Manadev\LayeredNavigationSliders\Sources\MinMaxRoleSource;
use Manadev\LayeredNavigationSliders\Sources\SliderStyleSource;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm as FilterFormBlock;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\Scripts;
use Manadev\LayeredNavigationSliders\Sources\CalculateSliderMinMaxSource;

class FilterForm
{
    /**
     * @var CalculateSliderMinMaxSource
     */
    protected $calculateSliderMinMaxSource;
    /**
     * @var YesNoSource
     */
    protected $yesNoSource;
    /**
     * @var SliderStyleSource
     */
    protected $sliderStyleSource;
    /**
     * @var MinAttributeSource
     */
    protected $minAttributeSource;
    protected $minMaxRoleSource;

    public function __construct(
        CalculateSliderMinMaxSource $calculateSliderMinMaxSource,
        YesNoSource $yesNoSource,
        SliderStyleSource $sliderStyleSource,
        MinAttributeSource $minAttributeSource,
        MinMaxRoleSource $minMaxRoleSource
    ) {
        $this->calculateSliderMinMaxSource = $calculateSliderMinMaxSource;
        $this->yesNoSource = $yesNoSource;
        $this->sliderStyleSource = $sliderStyleSource;
        $this->minAttributeSource = $minAttributeSource;
        $this->minMaxRoleSource = $minMaxRoleSource;
    }

    public function beforeAssignForm(FilterFormBlock $block, Form $form, $dbFields, $filterDefaults) {
        $attributeType = $form->getModel()->getType();
        $isTypeForSlider = in_array($attributeType, ['price', 'decimal', 'dropdown']);

        if($isTypeForSlider) {
            $this->addScriptsToForm($block);

            $fieldSet = $form->addFieldset('slider_fieldset', [
                'legend' => __('Slider Settings'),
                'class' => 'fieldset-wide',
            ]);

            if($attributeType == "decimal") {
                $fieldSet->addField('min_max_role', 'select', array_merge($dbFields['min_max_role'], [
                    'name' => 'min_max_role',
                    'label' => __('Role in Min/Max Slider'),
                    'title' => __('Role in Min/Max Slider'),
                    'required' => true,
                    'options' => $this->minMaxRoleSource->getOptions(),
                    'default' => $filterDefaults['min_max_role'],
                    'note' => __("Slider settings are configured in the `Minimum Value` role."),
                ]));
                $fieldSet->addField('min_slider_code', 'select', array_merge($dbFields['min_slider_code'], [
                    'name' => 'min_slider_code',
                    'label' => __('Minimum Value Attribute'),
                    'title' => __('Minimum Value Attribute'),
                    'options' => $this->minAttributeSource->getOptions(),
                    'default' => $filterDefaults['min_slider_code'],
                ]));

            }

            $fieldSet->addField('calculate_slider_min_max_based_on', 'select', array_merge($dbFields['calculate_slider_min_max_based_on'], [
                'name' => 'calculate_slider_min_max_based_on',
                'label' => __('Calculate Slider Minimum and Maximum Values Based On'),
                'title' => __('Calculate Slider Minimum and Maximum Values Based On'),
                'required' => true,
                'options' => $this->calculateSliderMinMaxSource->getOptions(),
                'default' => $filterDefaults['calculate_slider_min_max_based_on'],
            ]));

            if($attributeType != "dropdown") {
                $fieldSet->addField('number_format', 'text', array_merge($dbFields['number_format'], [
                    'name' => 'number_format',
                    'label' => __('Number Format'),
                    'title' => __('Number Format'),
                    'required' => true,
                    'default' => $filterDefaults['number_format'],
                    'note' => __("0 will be replaced by actual number; all other characters will be displayed as entered."),
                ]));

                if($attributeType == "decimal") {
                    $fieldSet->addField('decimal_digits', 'text', array_merge($dbFields['decimal_digits'], [
                        'name' => 'decimal_digits',
                        'label' => __('Digits After the Decimal Point'),
                        'title' => __('Digits After the Decimal Point'),
                        'required' => true,
                        'default' => $filterDefaults['decimal_digits'],
                        'class' => 'validate-number',
                        'note' => __("Leave empty or 0 to round to whole numbers."),
                    ]));

                    $fieldSet->addField('is_two_number_formats', 'select', array_merge($dbFields['is_two_number_formats'], [
                        'name' => 'is_two_number_formats',
                        'label' => __('Use 2 Number Formats'),
                        'title' => __('Use 2 Number Formats'),
                        'required' => true,
                        'options' => $this->yesNoSource->getOptions(),
                        'default' => $filterDefaults['is_two_number_formats'],
                    ]));

                    $fieldSet->addField('use_second_number_format_on', 'text', array_merge($dbFields['use_second_number_format_on'], [
                        'name' => 'use_second_number_format_on',
                        'label' => __('Use Second Number Format If Value Is Greater Than'),
                        'title' => __('Use Second Number Format If Value Is Greater Than'),
                        'required' => true,
                        'default' => $filterDefaults['use_second_number_format_on'],
                        'class' => 'validate-number',
                    ]));

                    $fieldSet->addField('second_number_format', 'text', array_merge($dbFields['second_number_format'], [
                        'name' => 'second_number_format',
                        'label' => __('Second Number Format'),
                        'title' => __('Second Number Format'),
                        'required' => true,
                        'default' => $filterDefaults['second_number_format'],
                        'note' => __("0 will be replaced by actual number; all other characters will be displayed as entered."),
                    ]));

                    $fieldSet->addField('second_decimal_digits', 'text', array_merge($dbFields['second_decimal_digits'], [
                        'name' => 'second_decimal_digits',
                        'label' => __('Digits After the Decimal Point (for Second Format)'),
                        'title' => __('Digits After the Decimal Point (for Second Format)'),
                        'required' => true,
                        'default' => $filterDefaults['second_decimal_digits'],
                        'class' => 'validate-number',
                        'note' => __("Leave empty or 0 to round to whole numbers."),
                    ]));
                }
                $fieldSet->addField('show_thousand_separator', 'select', array_merge($dbFields['show_thousand_separator'], [
                    'name' => 'show_thousand_separator',
                    'label' => __('Show Thousand Separator'),
                    'title' => __('Show Thousand Separator'),
                    'required' => true,
                    'options' => $this->yesNoSource->getOptions(),
                    'default' => $filterDefaults['show_thousand_separator'],
                ]));
                $fieldSet->addField('is_slide_on_existing_values', 'select', array_merge($dbFields['is_slide_on_existing_values'], [
                    'name' => 'is_slide_on_existing_values',
                    'label' => __('Slide Only Through Existing Values'),
                    'title' => __('Slide Only Through Existing Values'),
                    'required' => true,
                    'options' => $this->yesNoSource->getOptions(),
                    'default' => $filterDefaults['is_slide_on_existing_values'],
                ]));
                $fieldSet->addField('is_manual_range', 'select', array_merge($dbFields['is_manual_range'], [
                    'name' => 'is_manual_range',
                    'label' => __('Allow Customer to Enter Range Manually'),
                    'title' => __('Allow Customer to Enter Range Manually'),
                    'required' => true,
                    'options' => $this->yesNoSource->getOptions(),
                    'default' => $filterDefaults['is_manual_range'],
                ]));
            }

            $fieldSet->addField('slider_style', 'select', array_merge($dbFields['slider_style'], [
                'name' => 'slider_style',
                'label' => __('Style'),
                'title' => __('Style'),
                'options' => $this->sliderStyleSource->getOptions(),
                'default' => $filterDefaults['slider_style'],
            ]));
        }
    }

    /**
     * @param FilterFormBlock $block
     */
    protected function addScriptsToForm(FilterFormBlock $block) {
        /** @var Scripts $scriptsBlock */
        $scriptsBlock = $block->getLayout()->getBlock('mana.filter.scripts');
        $scriptsBlock->addScript('sliderFormScript');
    }
}