<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationShowMore\Plugins;

use Magento\Framework\Registry;
use Manadev\Core\Forms\Form;
use Manadev\Core\Sources\YesNoSource;
use Manadev\LayeredNavigation\Registries\FilterTypes;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm as FilterFormBlock;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\Scripts;
use Manadev\LayeredNavigationShowMore\Sources\MethodOfShowingItems;

class FilterForm
{
    protected $methodOfShowingItems;
    /**
     * @var YesNoSource
     */
    protected $yesNoSource;
    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var FilterTypes
     */
    protected $filterTypes;

    public function __construct(MethodOfShowingItems $methodOfShowingItems, YesNoSource $yesNoSource,
        Registry $registry, FilterTypes $filterTypes)
    {
        $this->methodOfShowingItems = $methodOfShowingItems;
        $this->yesNoSource = $yesNoSource;
        $this->registry = $registry;
        $this->filterTypes = $filterTypes;
    }

    public function beforeAssignForm(FilterFormBlock $block, Form $form, $dbFields, $filterDefaults) {
        /* @var Scripts $scriptsBlock */
        $scriptsBlock = $block->getLayout()->getBlock('mana.filter.scripts');
        $scriptsBlock->addScript('Manadev_LayeredNavigationShowMore/js/showMoreFormScript', [
            'eligible_templates' => $this->getEligibleTemplates(),
        ]);

        $fieldset = $form->getElement('template_fieldset');

        // Add Method of Showing All Options
        $fieldset->addField('show_more_method', 'select', array_merge($dbFields['show_more_method'], [
            'name' => 'show_more_method',
            'label' => __('Method of Showing All Options'),
            'title' => __('Method of Showing All Options'),
            'required' => true,
            'options' => $this->methodOfShowingItems->getOptions(),
            'default' => $filterDefaults['show_more_method'],
        ]));

        // Add Number of Always Shown Options
        $fieldset->addField('show_more_item_limit', 'text', array_merge($dbFields['show_more_item_limit'], [
            'name' => 'show_more_item_limit',
            'label' => __('Number of Always Shown Options'),
            'title' => __('Number of Always Shown Options'),
            'class' => 'validate-number',
            'required' => true,
            'default' => $filterDefaults['show_more_item_limit'],
        ]));

        $fieldset->addField('show_option_search', 'select', array_merge($dbFields['show_option_search'], [
            'name' => 'show_option_search',
            'label' => __('Show Option Search'),
            'title' => __('Show Option Search'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['show_option_search'],
        ]));
    }

    protected function getEligibleTemplates() {
        /* @var $filter \Manadev\LayeredNavigation\Models\Filter */
        $filter = $this->registry->registry('filter');
        $type = $this->filterTypes->get($filter->getData('type'));
        $eligibleTemplates = [];
        foreach ($type->getTemplates()->getList() as $templateName => $template) {
            if ($template->isShowMoreApplicable()) {
                $eligibleTemplates[] = $templateName;
            }
        }

        return $eligibleTemplates;
    }
}