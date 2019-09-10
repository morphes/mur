<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Product related block
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Murata\Catalog\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class Related extends \Magento\Framework\View\Element\Template
{
    protected $_resource;
    protected $connection;
    protected $_product;
    protected $_coreRegistry = null;
    protected $_productCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_resource = $resource;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    protected function getConnection()
    {
        if (!$this->connection) {
            $this->connection = $this->_resource->getConnection('core_write');
        }
        return $this->connection;
    }

    public function getRelatedProducts()
    {
        if($this->getProduct()) {
            $relatedProducts = $this->getConnection()->fetchAll(
                'SELECT * FROM catalog_product_link WHERE product_id = ' . (int) $this->getProduct()->getId()
            );
            $relatedProductsOutput = [];
            foreach($relatedProducts as $relatedProduct) {
                $relatedProductsOutput[] = $relatedProduct['linked_product_id'];
            }
            if(count($relatedProductsOutput)) {
                $collection = $this->_productCollectionFactory->create();
                $collection->addAttributeToSelect('*');
                $collection->addAttributeToFilter('entity_id', $relatedProductsOutput);
                $collection->setOrder('id');
                return $collection;
            }
        }
        return [];
    }
}
