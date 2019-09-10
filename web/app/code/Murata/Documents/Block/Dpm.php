<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Documents\Block;

/**
 * Footer
 *
 * @api
 * @since 100.0.2
 */
class Dpm extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'Murata_Documents::series_3d_magnetics.phtml';

    protected $_productCollectionFactory = null;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getLoadedProductCollection()
    {
        $sortBy = $this->getRequest()->getParam('sort', 'name');
        $collection = $this->_productCollectionFactory->create();
        $collection
            ->addFieldToFilter(
                [
                    ['attribute' => 'series_status', 'eq' => ''],
                    ['attribute' => 'series_status', 'neq' => '']
                ])->
            joinTable(
                ['series_status_value'=>'eav_attribute_option_value'],'option_id = series_status',
                ['series_status_value' => 'value']
            )
            ->addAttributeToFilter(
                'series_status_value', ['like' => '%recommended%']
            )
            ->addFieldToFilter(
                [
                    ['attribute' => 'series_type', 'eq' => ''],
                    ['attribute' => 'series_type', 'neq' => '']
                ])
            ->joinTable(
                ['series_type_value' => 'eav_attribute_option_value'],'option_id = series_type', ['series_type_value' => 'value']
            )
            ->addAttributeToFilter(
                'series_type_value', ['like' => '%Digital Panel Meter%']
            )
            ->addAttributeToFilter(
                'series_3d_solidworks', ['neq' => '']
            )
            ->addAttributeToFilter(
                'status', ['eq' => 1]
            )
            ->addAttributeToSelect(
                ['name', 'series_datasheet', 'series_3d_details', 'series_status', 'series_type', 'series_3d_solidworks', 'series_3d_step', 'series_3d_iges', 'series_3d_pdf']
            )
            ->addAttributeToSort($sortBy, 'ASC');
        $collection->getSelect()
            ->group('entity_id');
        return $collection;
    }


}
