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
class EolTable extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'Murata_Documents::eol_table.phtml';

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
                ['series_status_value'=>'eav_attribute_option_value'],
                'option_id = series_status', ['series_status_value' => 'value']
            )
            ->addAttributeToFilter(
                'series_status_value', ['like' => '%discontinued%']
            )
            ->addFieldToFilter('series_primary', ['eq' => 'Yes'])
            ->addAttributeToSelect(array('name', 'series_datasheet', 'series_status', 'eol_date', 'series_type'))
            ->addAttributeToSort($sortBy, 'ASC');
        return $collection;
    }
}
