<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category   BSS
 * @package    Bss_CmsPageImportExport
 * @author     Extension Team
 * @copyright  Copyright (c) 2017-2018 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\CmsPageImportExport\Block\Adminhtml\Export\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\ImportExport\Model\Source\Export\EntityFactory
     */
    protected $entityFactory;

    /**
     * @var \Magento\ImportExport\Model\Source\Export\FormatFactory
     */
    protected $formatFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\ImportExport\Model\Source\Export\EntityFactory $entityFactory
     * @param \Magento\ImportExport\Model\Source\Export\FormatFactory $formatFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\ImportExport\Model\Source\Export\EntityFactory $entityFactory,
        \Magento\ImportExport\Model\Source\Export\FormatFactory $formatFactory,
        array $data = []
    ) {
        $this->entityFactory = $entityFactory;
        $this->formatFactory = $formatFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/export'),
                    'method' => 'post',
                ],
            ]
        );

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Export Settings')]);
        $fieldset->addField(
            'entity',
            'select',
            [
                'name' => 'entity',
                'title' => __('Entity Type'),
                'label' => __('Entity Type'),
                'required' => false,
                'values' => $this->entityFactory->create()->toOptionArray()
            ]
        );
        $fieldset->addField(
            'file_format',
            'select',
            [
                'name' => 'file_format',
                'title' => __('Export File Format'),
                'label' => __('Export File Format'),
                'required' => false,
                'values' => $this->formatFactory->create()->toOptionArray()
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
