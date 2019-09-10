<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Plugins;

use Manadev\Core\Features;
use Manadev\Core\Forms\Form;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm as FilterFormBlock;
use Manadev\Core\Sources\YesNoSource;

class FilterForm
{
    /**
     * @var YesNoSource
     */
    protected $yesNoSource;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(YesNoSource $yesNoSource, Features $features) {
        $this->yesNoSource = $yesNoSource;
        $this->features = $features;
    }
    
    public function beforeAssignForm(FilterFormBlock $block, Form $form, $dbFields, $filterDefaults) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return;
        }

        if (!($fieldSet = $form->getElement('positioning_fieldset'))) {
            $fieldSet = $form->addFieldset('positioning_fieldset', [
                'legend' => __('Show Filters In Following Positions'),
                'class' => 'fieldset-wide',
            ], 'template_fieldset');
        }

        $fieldSet->addField('show_on_mobile', 'select', array_merge($dbFields['show_on_mobile'], [
            'name' => 'show_on_mobile',
            'label' => __('On Mobile Devices'),
            'title' => __('On Mobile Devices'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['show_on_mobile'],
        ]));
    }
}