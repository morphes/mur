<?php

namespace MageArray\News\Block\Widget;

use MageArray\News\Helper\Data;
use MageArray\News\Model\NewspostFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

/**
 * Class Archive
 * @package MageArray\News\Block\Widget
 */
class Product extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'widget/product.phtml';
    /**
     * @var NewspostFactory
     */
    protected $_productFactory;
    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected $_newsCollection;
    /**
     * @var
     */
    protected $_monthyear;

    protected $_productId;

    /**
     * Archive constructor.
     * @param Context $context
     * @param Data $dataHelper
     * @param array $data
     * @param NewspostFactory $modelNewsFactory
     */
    public function __construct(
        Context $context,
        Data $dataHelper,
        array $data = [],
        \Magento\Catalog\Model\ProductRepository $productFactory
    ) {
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $data);
        $this->_productId = $this->getProduct();
        $this->_productFactory = $productFactory;
    }

    public function getNewsProduct()
    {
        return $this->_productFactory->get($this->_productId);
    }
}
