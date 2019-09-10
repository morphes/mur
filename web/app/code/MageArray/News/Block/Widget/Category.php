<?php

namespace MageArray\News\Block\Widget;

use MageArray\News\Model\NewscatFactory;
use MageArray\News\Model\NewspostFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

/**
 * Class Latest
 * @package MageArray\News\Block\Widget
 */
class Category extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'widget/category.phtml';

    /**
     * @var NewspostFactory
     */
    protected $_modelNewsFactory;

    protected $_modelNewsCategoriesFactory;

    /**
     * Latest constructor.
     * @param Context $context
     * @param array $data
     * @param NewspostFactory $modelNewsFactory
     */
    public function __construct(
        Context $context,
        array $data = [],
        NewspostFactory $modelNewsFactory,
        NewscatFactory $modelNewsCategoriesFactory
    ) {
        $this->_modelNewsFactory = $modelNewsFactory;
        $this->_modelNewsCategoriesFactory = $modelNewsCategoriesFactory;
        parent::__construct($context, $data);
        $count = $this->getCount();
        $category = $this->getCategory();
        $now = date('Y-m-d');
        $collection = $this->_modelNewsFactory->create()->getCollection();
        $collection->setActiveFilter(true)->setPostFilter();
        $collection->setStoreFilter($this->getStoreId());
        $collection->addFieldToFilter('publish_date', ['lteq' => $now]);
        $collection->addFieldToFilter('category', ['like' => '%' . $category . '%']);
        $collection->setOrder('publish_date', 'DESC');
        if (isset($count) && $count != '') {
            $collection->setPageSize($count);
        } else {
            $collection->setPageSize(5);
        }
        $this->setCollection($collection);
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        return $this;
    }

    public function getWidgetCategory()
    {
        $categories = $this->_modelNewsCategoriesFactory->create();
        return $categories->load($this->getCategory());
    }
}
