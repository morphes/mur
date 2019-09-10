<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Documents\Block\Certificates;

/**
 * Footer
 *
 * @api
 * @since 100.0.2
 */
class CertificatesAbstract extends \Magento\Framework\View\Element\Template
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

    public function getCertificatesStatuses($product)
    {
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProduct($product)
            ->setTemplate('Murata_Category::series_statuses.phtml')
            ->toHtml();
    }

    public function getCertificatesCollection($certificateType)
    {
        $sortBy = $this->getRequest()->getParam('sort', 'name');
        $collection = $this->_productCollectionFactory->create();
        $collection
            ->addFieldToFilter([
                    ['attribute' => 'series_status', 'eq' => ''],
                    ['attribute' => 'series_status', 'neq' => '']
                ])
            ->joinTable(
                ['series_status_value'=>'eav_attribute_option_value'],'option_id = series_status',
                ['series_status_value' => 'value']
            )
            ->addAttributeToFilter('series_status_value', ['like' => '%recommended%'])
            ->addFieldToFilter([
                    ['attribute' => 'series_type', 'eq' => ''],
                    ['attribute' => 'series_type', 'neq' => '']
                ])
            ->joinTable(
                ['series_type_value'=>'eav_attribute_option_value'],'option_id = series_type', ['series_type_value' => 'value']
            )
            ->addAttributeToFilter('series_type_value', ['like' => '%'.$certificateType.'%'])
            ->addAttributeToFilter('status', ['eq' => 1])
            ->addAttributeToFilter('safety_list', ['neq' => ''])
            ->addAttributeToSelect(
                ['name', 'series_datasheet', 'series_status', 'series_type', 'safety_list', 'safety_ul_ite', 'safety_ul_med', 'safety_cb_ite', 'safety_cd_med', 'safety_csa', 'safety_vde', 'safety_tuv', 'safety_ccc', 'safety_demko', 'safety_bsmi']
            )
            ->addAttributeToSort($sortBy, 'ASC');
        return $collection;
    }


}
