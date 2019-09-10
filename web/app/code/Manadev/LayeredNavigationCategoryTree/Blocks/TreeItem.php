<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Blocks;

use Magento\Framework\View\Element\Template;
use Manadev\LayeredNavigation\Blocks\FilterRenderer;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigationCategoryTree\FilterTemplates\Category\Tree;

class TreeItem extends Template
{
    protected $_template = 'Manadev_LayeredNavigationCategoryTree::filter/treeItem.phtml';

    /**
     * @var Tree
     */
    protected $filterTemplate;
    /**
     * @var EngineFilter
     */
    protected $engineFilter;
    /**
     * @var FilterRenderer
     */
    protected $filterRenderer;

    public function __construct(
        Template\Context $context,
        EngineFilter $engineFilter,
        FilterRenderer $filterRenderer,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->engineFilter = $engineFilter;
        $this->filterRenderer = $filterRenderer;
    }

    protected function _toHtml() {
        $engineFilter = $this->engineFilter;

        $this->assign(
            [
                'item' => $this->getData(),
                'data' => $engineFilter->getData(),
                'filterTemplate' => $engineFilter->getFilterTemplate(),
                'filter' => $engineFilter->getFilter(),
                'engineFilter' => $engineFilter,
                'filterRenderer' => $this->filterRenderer,
            ]
        );

        return parent::_toHtml();
    }
}