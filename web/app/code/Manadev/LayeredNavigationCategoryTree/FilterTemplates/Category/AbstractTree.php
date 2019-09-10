<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\FilterTemplates\Category;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Session;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\LayeredNavigation\Blocks\FilterRenderer;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigation\FilterTemplates\Category\TextSingleSelect;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigation\RequestParser;
use Manadev\LayeredNavigationCategoryTree\Configuration;
use Manadev\ProductCollection\Contracts\ProductCollection;
use Manadev\ProductCollection\Factory;

abstract class AbstractTree extends TextSingleSelect
{
    /**
     * @var LayoutInterface
     */
    protected $layout;
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var Session
     */
    protected $catalogSession;
    /**
     * @var Configuration
     */
    protected $config;

    public function __construct(
        RequestParser $requestParser,
        Factory $factory,
        CategoryRepositoryInterface $categoryRepository,
        StoreManagerInterface $storeManager,
        LayoutInterface $layout,
        UrlInterface $urlBuilder,
        Session $catalogSession,
        Configuration $config
    ) {
        parent::__construct($requestParser, $factory, $categoryRepository, $storeManager);
        $this->layout = $layout;
        $this->urlBuilder = $urlBuilder;
        $this->catalogSession = $catalogSession;
        $this->config = $config;
    }

    public function getFilename(Filter $filter) {
        return 'Manadev_LayeredNavigationCategoryTree::filter/tree.phtml';
    }

    public function renderTreeItem(array $categoryData, EngineFilter $engineFilter, FilterRenderer $filterRenderer) {
        return $this->layout->createBlock(
            \Manadev\LayeredNavigationCategoryTree\Blocks\TreeItem::class,
            null,
            [
                'engineFilter' => $engineFilter,
                'filterRenderer' => $filterRenderer,
                'data' => $categoryData
            ]
        )->toHtml();
    }


    public function getSaveStateURL() {
        return $this->urlBuilder->getUrl('mana_category_tree/tree/saveState');
    }

    /**
     * @return mixed
     */
    public function getTreeState(){
        return $this->catalogSession->getManaTreeState();
    }

    public function prepare(ProductCollection $productCollection, Filter $filter) {
        $query = $productCollection->getQuery();
        $name = $filter->getData('param_name');
        /** @var \Magento\Store\Model\Store $store */
        $store = $this->storeManager->getStore();
        $currentCategory = $query->getCategory();
        $appliedCategory = false;

        if (($appliedCategoryId = $this->requestParser->readSingleValueInteger($name)) !== false) {
            $query->getFilterGroup('layered_nav')->addOperand($this->factory->createLayeredCategoryFilter(
                $name, [$appliedCategoryId]));

            /* @var $appliedCategory Category */
            $appliedCategory = $this->categoryRepository->get($appliedCategoryId, $store->getId());
        }

        $query->addFacet($this->createFacet($filter, $appliedCategory, $currentCategory));
    }

    public function getTreeItemClass($item) {
        if($item['children']) {
            return
                ($this->isTreeAllExpanded()) ||
                ($this->isTreeSelectedExpanded() && ($item['is_selected'] || $this->_isChildSelected($item)))
                    ? 'mana-expanded': 'mana-collapsed';
        } else {
            return "mana-leaf";
        }
    }

    protected function _isChildSelected($item) {
        foreach($item['children'] as $child) {
            if($child['is_selected']) {
                return true;
            }
            if($child['children']) {
                return $this->_isChildSelected($child);
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isTreeAllExpanded() {
        return $this->config->isExpandAllItemsOnInitialLoad();
    }

    protected function isTreeSelectedExpanded() {
        return $this->config->isExpandSelected();
    }

    /**
     * @param Filter $filter
     * @param Category|bool $appliedCategory
     * @param Category $currentCategory
     *
     * @return mixed
     */
    abstract protected function createFacet($filter, $appliedCategory, $currentCategory);
}
