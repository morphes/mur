<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\Core\Forms\Form;
use Manadev\Core\Sources\YesNoSource;
use Manadev\LayeredNavigation\Registries\FilterTypes;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm as FilterFormBlock;
use Manadev\Seo\Enums\QueryPart;
use Manadev\Seo\Enums\UrlKeySubType as UrlKeySubTypeEnum;

class FilterForm
{
    /**
     * @var YesNoSource
     */
    protected $yesNoSource;
    /**
     * @var QueryPart
     */
    protected $queryPart;
    /**
     * @var FilterTypes
     */
    protected $filterTypes;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(YesNoSource $yesNoSource, QueryPart $queryPart, FilterTypes $filterTypes,
        Features $features)
    {
        $this->yesNoSource = $yesNoSource;
        $this->queryPart = $queryPart;
        $this->filterTypes = $filterTypes;
        $this->features = $features;
    }

    public function beforeAssignForm(FilterFormBlock $block, Form $form, $dbFields, $filterDefaults) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return;
        }

        $filterType = $this->filterTypes->get($form->getModel()->getType());

        $fieldSet = $form->addFieldset('seo_fieldset', [
            'legend' => __('SEO Settings'),
            'class' => 'fieldset-wide',
        ]);

        if ($filterType->getSeoParameterSubType() == UrlKeySubTypeEnum::OPTION_FILTER_PARAMETER) {
            $fieldSet->addField('use_filter_title_in_url', 'select', array_merge($dbFields['use_filter_title_in_url'], [
                'name' => 'use_filter_title_in_url',
                'label' => __('Use Filter Title in URL'),
                'title' => __('Use Filter Title in URL'),
                'required' => true,
                'options' => $this->yesNoSource->getOptions(),
                'default' => $filterDefaults['use_filter_title_in_url'],
            ]));
        }

        $fieldSet->addField('url_part', 'select', array_merge($dbFields['url_part'], [
            'name' => 'url_part',
            'label' => __('URL Part'),
            'title' => __('URL Part'),
            'required' => true,
            'options' => $this->queryPart->getOptions(),
            'default' => $filterDefaults['url_part'],
        ]));

        $fieldSet->addField('position_in_url', 'text', array_merge($dbFields['position_in_url'], [
            'name' => 'position_in_url',
            'label' => __('Position in URL'),
            'title' => __('Position in URL'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['position_in_url'],
            'class' => 'validate-number',
        ]));

        $fieldSet->addField('include_in_canonical_url', 'select', array_merge($dbFields['include_in_canonical_url'], [
            'name' => 'include_in_canonical_url',
            'label' => __('Include in Canonical URL'),
            'title' => __('Include in Canonical URL'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['include_in_canonical_url'],
        ]));

        $fieldSet->addField('force_no_index', 'select', array_merge($dbFields['force_no_index'], [
            'name' => 'force_no_index',
            'label' => __('Force NOINDEX If Filter is Applied'),
            'title' => __('Force NOINDEX If Filter is Applied'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['force_no_index'],
        ]));

        $fieldSet->addField('force_no_follow', 'select', array_merge($dbFields['force_no_follow'], [
            'name' => 'force_no_follow',
            'label' => __('Force NOFOLLOW If Filter is Applied'),
            'title' => __('Force NOFOLLOW If Filter is Applied'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['force_no_follow'],
        ]));

        $fieldSet->addField('include_in_meta_title', 'select', array_merge($dbFields['include_in_meta_title'], [
            'name' => 'include_in_meta_title',
            'label' => __('Include in Meta Title'),
            'title' => __('Include in Meta Title'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['include_in_meta_title'],
        ]));

        $fieldSet->addField('include_in_meta_description', 'select', array_merge($dbFields['include_in_meta_description'], [
            'name' => 'include_in_meta_description',
            'label' => __('Include in Meta Description'),
            'title' => __('Include in Meta Description'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['include_in_meta_description'],
        ]));

        $fieldSet->addField('include_in_meta_keywords', 'select', array_merge($dbFields['include_in_meta_keywords'], [
            'name' => 'include_in_meta_keywords',
            'label' => __('Include in Meta Keywords'),
            'title' => __('Include in Meta Keywords'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['include_in_meta_keywords'],
        ]));

        /*$fieldSet->addField('include_in_sitemap', 'select', array_merge($dbFields['include_in_sitemap'], [
            'name' => 'include_in_sitemap',
            'label' => __('Include in Sitemap'),
            'title' => __('Include in Sitemap'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['include_in_sitemap'],
        ]));*/
    }

}