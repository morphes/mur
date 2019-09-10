<?php

namespace MageArray\News\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use MageArray\News\Model\NewscatFactory;

/**
 * Class Sorting
 * @package MageArray\News\Model\Config\Source
 */
class Categories implements ArrayInterface
{

    protected $_categoriesManager;

    public function __construct(
        NewscatFactory $categoriesManager
    ) {
        $this->_categoriesManager = $categoriesManager;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {

        $categories = $this->_categoriesManager->create();
        $categories = $categories->getCollection();
        $options = [];
        foreach($categories as $category) {
            $options[] = [
                'value' => $category->getCatId(),
                'label' => $category->getCatName()
            ];
        }
        return $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->toOptionArray();
    }
}
