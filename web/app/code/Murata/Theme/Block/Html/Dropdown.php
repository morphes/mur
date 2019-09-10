<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Theme\Block\Html;

/**
 * Footer
 *
 * @api
 * @since 100.0.2
 */
class Dropdown extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory = null;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getProducts()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection
            ->addFieldToFilter([
                ['attribute' => 'series_status', 'eq' => ''],
                ['attribute' => 'series_status', 'neq' => '']
            ])
            ->joinTable(
                ['series_status_value' => 'eav_attribute_option_value'],'option_id = series_status',
                ['series_status_value' => 'value']
            )
            ->addAttributeToFilter('series_status_value', ['like' => '%Recommended%'])
            ->addFieldToFilter('series_primary', ['eq' => 'Yes'])
            ->addAttributeToSelect(['name', 'series_datasheet', 'series_primary'])
            ->addAttributeToSort('name', 'ASC');
        return $collection;
    }
}
