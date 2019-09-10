<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Resources\Facets\Category;

use Magento\Catalog\Model\Category;
use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\LayeredNavigationCategoryTree\Facets\Category\AbstractChildFacet;
use Manadev\ProductCollection\Configuration;
use Manadev\ProductCollection\Contracts\Facet;
use Manadev\ProductCollection\Contracts\FacetResource;
use Manadev\ProductCollection\Factory;
use Manadev\ProductCollection\Resources\HelperResource;
use Zend_Db_Select;

abstract class AbstractChildFacetResource extends FacetResource
{
    /**
     * @var mixed
     */
    protected $_counts = false;
    protected $_productCountSelect = null;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\Flat
     */
    protected $flatResource;
    /**
     * @var AbstractChildFacet
     */
    protected $_facet;
    /**
     * @var Select
     */
    protected $_productSelect;
    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;
    /**
     * @var \Magento\Catalog\Model\Indexer\Category\Flat\State
     */
    protected $flatState;
    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $eavConfig;
    /**
     * @var \Manadev\LayeredNavigationCategoryTree\Configuration
     */
    protected $treeConfig;

    public function __construct(
        Db\Context $context,
        Factory $factory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        Configuration $configuration,
        \Magento\Catalog\Model\ResourceModel\Category\Flat $flatResource,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $flatState,
        HelperResource $helperResource,
        \Magento\Eav\Model\Config $eavConfig,
        \Manadev\LayeredNavigationCategoryTree\Configuration $treeConfig,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $factory, $storeManager, $configuration, $helperResource, $resourcePrefix);
        $this->flatResource = $flatResource;
        $this->eventManager = $eventManager;
        $this->flatState = $flatState;
        $this->eavConfig = $eavConfig;
        $this->treeConfig = $treeConfig;
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() {
        $this->_setMainTable('catalog_product_entity');
    }

    /**
     * @param Select $select
     * @param Facet  $facet
     *
     * @return mixed
     */
    public function count(Select $select, Facet $facet) {
        return $this->getCounts();
    }

    public function getFilterCallback(Facet $facet) {
        return $this->helperResource->dontApplyFilterNamed($facet->getName());
    }

    public function prepare(Select $select, Facet $facet) {
        /** @var AbstractChildFacet $facet */
        $this->setProductSelect($this->_removeCategoryIdFilter($select));
        $this->setFacet($facet);

        $result = $this->_processCategoryCounts();
        $this->setCounts(count($result) ? $result : false);
    }

    public function isPreparationStepNeeded() {
        return true;
    }

    public function useDirectSelect() {
        return true;
    }

    public function getPreparationFilterCallback(Facet $facet) {
        return $this->helperResource->dontApplyFilterNamed($facet->getName());
    }

    protected function _processCategoryCounts() {
        $categories = $this->getCategoryData();
        $this->addCountToCategories($categories);
        $result = $this->toFilterData($categories);
        $result = $this->organizeChildren($result);

        return count($result) ? $result : false;
    }

    protected function addCountToCategories(&$categories) {
        $isAnchor = [];
        $isNotAnchor = [];
        foreach ($categories as $category) {
            if ($category['is_anchor']) {
                $isAnchor[] = $category['entity_id'];
            } else {
                $isNotAnchor[] = $category['entity_id'];
            }
        }
        $productCounts = [];
        if ($isAnchor || $isNotAnchor) {
            $select = $this->getProductCountSelect();
            if ($isAnchor) {
                $anchorStmt = clone $select;
                $anchorStmt->limit();
                //reset limits
                $anchorStmt->where('count_table.category_id IN (?)', $isAnchor);
                $productCounts += $this->getConnection()->fetchPairs($anchorStmt);
                $anchorStmt = null;
            }
            if ($isNotAnchor) {
                $notAnchorStmt = clone $select;
                $notAnchorStmt->limit();
                //reset limits
                $notAnchorStmt->where('count_table.category_id IN (?)', $isNotAnchor);
                $notAnchorStmt->where('count_table.is_parent = 1');
                $productCounts += $this->getConnection()->fetchPairs($notAnchorStmt);
                $notAnchorStmt = null;
            }
            $select = null;
            $this->unsProductCountSelect();
        }

        foreach ($categories as $i => $category) {
            $_count = 0;
            if (isset($productCounts[$category['entity_id']])) {
                $_count = $productCounts[$category['entity_id']];
            }
            $categories[$i]['product_count'] = $_count;
        }
    }

    protected function unsProductCountSelect() {
        $this->_productCountSelect = null;
    }

    protected function getProductCountSelect()
    {
        if ($this->_productCountSelect === null) {
            $this->_productCountSelect = clone $this->getProductSelect();
            $this->_productCountSelect->reset(
                \Magento\Framework\DB\Select::COLUMNS
            )->reset(
                \Magento\Framework\DB\Select::GROUP
            )->reset(
                \Magento\Framework\DB\Select::ORDER
            )->distinct(
                false
            )->join(
                ['count_table' => $this->getTable('catalog_category_product_index')],
                'count_table.product_id = e.entity_id',
                [
                    'count_table.category_id',
                    'product_count' => new \Zend_Db_Expr('COUNT(DISTINCT count_table.product_id)')
                ]
            )->where(
                'count_table.store_id = ?',
                $this->getStoreId()
            )->group(
                'count_table.category_id'
            );
        }

        return $this->_productCountSelect;
    }

    /**
     * @param Select $select
     *
     * @return Select
     */
    protected function _removeCategoryIdFilter(Select $select) {
        $select->getPart(Zend_Db_Select::FROM);
        $from = $select->getPart(Zend_Db_Select::FROM);
        if (isset($from['cat_index'])) {
            // Remove the category_id in join
            $from['cat_index']['joinCondition'] = preg_replace(
                "/(.*)( AND ?)(`?)cat_index(`?).(`?)category_id(`?)='(\\d+)'(.*)/",
                "$1$8",
                $from['cat_index']['joinCondition']
            );
            $select->setPart(Zend_Db_Select::FROM, $from);
        }

        return $select;
    }

    /**
     * @return Select
     */
    protected function getProductSelect() {
        return $this->_productSelect;
    }

    /**
     * @return Select
     */
    protected function _initCategorySelect() {
        $db = $this->getConnection();
        $cat_table = $this->flatState->isAvailable() ?
            $this->flatResource->getMainTable():
            $this->getTable('catalog_category_entity');

        $cols = ['entity_id', 'parent_id', 'level', 'path'];

        if($this->flatState->isAvailable()) {
            $cols = array_merge($cols, ['is_active', 'name', 'is_anchor']);
            $select = $db->select()
                ->from(['main_table' => $cat_table], [])
                ->where('is_active = ?', 1)
                ->columns($cols)
                ->order("position ASC");
            ;
        } else {
            $is_active_expr = "COALESCE(`s_is_active`.`value`, `g_is_active`.`value`)";
            $cols['is_active'] = new \Zend_Db_Expr("{$is_active_expr}");
            $cols['is_anchor'] = new \Zend_Db_Expr("COALESCE(`s_is_anchor`.`value`, `g_is_anchor`.`value`)");
            $cols['name'] = new \Zend_Db_Expr("COALESCE(`s_name`.`value`, `g_name`.`value`)");
            $isActiveAttr = $this->eavConfig->getAttribute(Category::ENTITY, 'is_active');
            $isAnchorAttr = $this->eavConfig->getAttribute(Category::ENTITY, 'is_anchor');
            $nameAttr = $this->eavConfig->getAttribute(Category::ENTITY, 'name');

            $select = $db->select()
                ->from(['main_table' => $cat_table], [])

                ->joinInner(['g_is_active' => $this->getTable($cat_table . '_int')],
                    "`main_table`.`entity_id` = `g_is_active`.`entity_id` AND `g_is_active`.`store_id` = 0 AND `g_is_active`.`attribute_id` = ". $isActiveAttr->getId(),
                    [])
                ->joinLeft(['s_is_active' => $this->getTable($cat_table . '_int')],
                    "`main_table`.`entity_id` = `s_is_active`.`entity_id` AND `s_is_active`.`store_id` = " . $this->getStoreId() . " AND `s_is_active`.`attribute_id` = ". $isActiveAttr->getId(),
                    [])

                ->joinInner(['g_is_anchor' => $this->getTable($cat_table . '_int')],
                    "`main_table`.`entity_id` = `g_is_anchor`.`entity_id` AND `g_is_anchor`.`store_id` = 0 AND `g_is_anchor`.`attribute_id` = ". $isAnchorAttr->getId(),
                    [])
                ->joinLeft(['s_is_anchor' => $this->getTable($cat_table . '_int')],
                    "`main_table`.`entity_id` = `s_is_anchor`.`entity_id` AND `s_is_anchor`.`store_id` = " . $this->getStoreId() . " AND `s_is_anchor`.`attribute_id` = ". $isAnchorAttr->getId(),
                    [])

                ->joinInner(['g_name' => $this->getTable($cat_table . '_varchar')],
                    "`main_table`.`entity_id` = `g_name`.`entity_id` AND `g_name`.`store_id` = 0 AND `g_name`.`attribute_id` = ". $nameAttr->getId(),
                    [])
                ->joinLeft(['s_name' => $this->getTable($cat_table . '_varchar')],
                    "`main_table`.`entity_id` = `s_name`.`entity_id` AND `s_name`.`store_id` = " . $this->getStoreId() . " AND `s_name`.`attribute_id` = ". $nameAttr->getId(),
                    [])

                ->where("$is_active_expr = ?", 1)
                ->order("position ASC")
                ->columns($cols)
            ;
        }

        $this->_filterCategorySelect($select);

        return $select;
    }

    /**
     * @param Select $categorySelect
     *
     * @return void
     */
    abstract protected function _filterCategorySelect($categorySelect);

    protected function getCategoryData() {
        $categorySelect = $this->_initCategorySelect();
        return $this->getConnection()->fetchAssoc($categorySelect);
    }

    protected function toFilterData($categories) {
        $result = [];
        $facet = $this->getFacet();
        $appliedCategory = $facet->getAppliedCategory() ?: $facet->getQuery()->getCategory();

        foreach($categories as $i => $category) {
            if ($facet->hideEmptyProductCount() && !$category['product_count']) {
                continue;
            }

            $is_selected = $appliedCategory && $appliedCategory->getId() == $category['entity_id'];

            $result[$category['entity_id']] = [
                'label' => $category['name'],
                'value' => $category['entity_id'],
                'count' => $category['product_count'],
                'is_selected' => ($is_selected),
                'sort_order' => count($result),

                // To be used on organizing hierarchy.
                'parent_id' => $category['parent_id'],
                'child_ids' => [],
                'level' => $category['level'],
            ];
        }

        foreach($result as $filter) {
            if (array_key_exists($filter['parent_id'], $result)) {
                array_push($result[$filter['parent_id']]['child_ids'], $filter['value']);
            }
        }

        return $result;
    }

    protected function organizeChildren($result) {
        $organizedResult = [];
        $highestLevel = null;
        foreach ($result as $i => $filter) {
            if (is_null($highestLevel) || $highestLevel > $filter['level']) {
                $highestLevel = $filter['level'];
            }
        }

        foreach($result as $i => $filter) {
            if($filter['level'] == $highestLevel) {
                $organizedResult[] = $this->_getChildFromResult($filter, $result);
            }
        }
        return $organizedResult;
    }

    protected function _getChildFromResult($parentFilter, $result) {
        $parentFilter['children'] = false;
        if($parentFilter['child_ids']) {
            $children = [];
            foreach($parentFilter['child_ids'] as $child_id) {
                $children[] = $this->_getChildFromResult($result[$child_id], $result);
            }
            $parentFilter['children'] = $children;
        }
        unset($parentFilter['child_ids']);
        unset($parentFilter['level']);
        unset($parentFilter['parent_id']);

        return $parentFilter;
    }

    protected function setProductSelect($select) {
        $this->_productSelect = $select;
    }

    protected function setFacet($facet) {
        $this->_facet = $facet;
    }

    /**
     * @return AbstractChildFacet
     */
    protected function getFacet() {
        return $this->_facet;
    }

    /**
     * @return mixed
     */
    protected function getCounts() {
        return $this->_counts;
    }

    /**
     * @param mixed $counts
     */
    protected function setCounts($counts) {
        $this->_counts = $counts;
    }
}