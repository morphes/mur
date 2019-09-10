<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Blocks\Adminhtml;

use Manadev\Core\Blocks\Adminhtml\Form;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;

class UrlKeyForm extends Form
{

    /**
     * @var UrlKeyStatus
     */
    protected $urlKeyStatus;
    /**
     * @var UrlKeyType
     */
    protected $urlKeyType;
    /**
     * @var UrlKeySubType
     */
    protected $urlKeySubType;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        UrlKeyStatus $urlKeyStatus,
        UrlKeyType $urlKeyType,
        UrlKeySubType $urlKeySubType,
        array $data
    ) {
        parent::__construct($context, $registry, $formFactory, $objectManager, $data);
        $this->urlKeyStatus = $urlKeyStatus;
        $this->urlKeyType = $urlKeyType;
        $this->urlKeySubType = $urlKeySubType;
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setData('id', 'urlkey_form');
        $this->setData('title', __('URL Key'));
    }

    protected function _prepareForm()
    {
        /* @var $urlKey \Manadev\Seo\Models\UrlKey */
        $urlKey = $this->_coreRegistry->registry('urlKey');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->createForm([
            'data' => [
                'id' => 'edit_form',
                'action' => $this->getData('action'),
                'method' => 'post',
                'html_id_prefix' => 'url_key_',
                'use_container' => true,
                'model' => $urlKey,
            ]
        ]);

        $fieldSet = $form->addFieldset('general_fieldset', [
            'legend' => __('General'),
            'class' => 'fieldset-wide'
        ]);

        $fieldSet->addField('id', 'hidden', ['name' => 'id']);

        $fieldSet->addField('url_key', 'label', [
            'label' => __('URL Key'),
            'name' => 'url_key',
        ]);

        $fieldSet->addField('position', 'label', [
            'label' => __('Position'),
            'name' => 'position',
        ]);

        $fieldSet->addField('description', 'label', [
            'label' => __('Description'),
            'name' => 'description',
        ]);

        $fieldSet->addField('status', 'label', [
            'label' => __('Status'),
            'name' => 'status',
            'value_filter' => new \Zend_Filter_Callback(function($value) {
                return $this->urlKeyStatus->getOptions()[$value];
            }),
        ]);
        $fieldSet->addField('type', 'label', [
            'label' => __('Type'),
            'name' => 'type',
            'value_filter' => new \Zend_Filter_Callback(function($value) {
                return $this->urlKeyType->getOptions()[$value];
            }),
        ]);
        $fieldSet->addField('sub_type', 'label', [
            'label' => __('Sub Type'),
            'name' => 'sub_type',
            'value_filter' => new \Zend_Filter_Callback(function($value) {
                return $this->urlKeySubType->getOptions()[$value];
            }),
        ]);


        $fieldSet = $form->addFieldset('url_key_fieldset', [
            'legend' => __('URL Key Based On'),
            'class' => 'fieldset-wide'
        ]);

        $fieldSet->addField('inferred_url_key', 'label', [
            'label' => __('Inferred URL Key'),
            'name' => 'inferred_url_key',
        ]);
        $fieldSet->addField('assigned_url_key', 'text', [
            'name' => 'assigned_url_key',
            'label' => __('Assigned URL Key'),
            'title' => __('Assigned URL Key'),
            'note' => __('Use this field to override inferred URL key. Leave empty to use inferred URL key. Whitespace in URL key is not allowed and is trimmed.'),
            'required' => false,
        ]);
        $fieldSet->addField('conflict_resolution', 'label', [
            'label' => __('Conflict Resolution'),
            'name' => 'conflict_resolution',
        ]);

        $form->setValues($urlKey->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}