<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category   BSS
 * @package    Bss_MegaMenu
 * @author     Extension Team
 * @copyright  Copyright (c) 2016-2017 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\Megamenu\Block\Html;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class Menu extends Template
{
    /**
     * @var \Bss\Megamenu\Helper\Data
     */
    protected $helper;

    /**
     * @var \Bss\Megamenu\Model\Menu
     */
    protected $menu;

    /**
     * @var \Bss\Megamenu\Model\ResourceModel\MenuItems\Collection
     */
    protected $menuItemsCollection;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resource;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    private $registry;

    /**
     * @var \Magento\Theme\Block\Html\Topmenu
     */
    protected $topMenuDefault;

    const DEFAULT_STOREVIEW = '0';

    /**
     * Menu constructor.
     * @param Template\Context $context
     * @param \Bss\Megamenu\Helper\Data $helper
     * @param \Bss\Megamenu\Model\Menu $menu
     * @param \Bss\Megamenu\Model\ResourceModel\MenuItems\CollectionFactory $menuItemsCollection
     * @param \Magento\Theme\Block\Html\Topmenu $topMenuDefault
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Bss\Megamenu\Helper\Data $helper,
        \Bss\Megamenu\Model\Menu $menu,
        \Bss\Megamenu\Model\ResourceModel\MenuItems\CollectionFactory $menuItemsCollection,
        \Magento\Theme\Block\Html\Topmenu $topMenuDefault,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Customer\Model\Session $customerSession,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
        $this->topMenuDefault = $topMenuDefault;
        $this->menu = $menu;
        $this->storeManager = $context->getStoreManager();
        $this->menuItemsCollection = $menuItemsCollection;
        $this->customerSession = $customerSession;
        $this->resource = $resource;
        $this->registry = $registry;
        $this->scopeConfig = $context->getScopeConfig();
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * @return \Bss\Megamenu\Helper\Data
     */
    public function getHelperData()
    {
        return $this->helper;
    }

    /**
     * @return \Magento\Theme\Block\Html\Topmenu
     */
    public function getTopMenuDefault()
    {
        return $this->topMenuDefault;
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getStoreGroupId()
    {
        return $this->storeManager->getStore()->getStoreGroupId();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getHtml()
    {
        $storeId=$this->getStoreGroupId();
        $collection = $this->menuItemsCollection->create();
        $collection->addFieldToFilter('status', 1);
        $collection->addFieldToFilter('store_id', $storeId);

        if (!$collection->getSize()) {
            $storeId=0;
            $collection = $this->menuItemsCollection->create();
            $collection->addFieldToFilter('status', 1);
            $collection->addFieldToFilter('store_id', $storeId);
        }

        $new_arr = [];
        foreach ($collection->getData() as $arr) {
            $new_arr['j1_'.$arr['menu_id']] = $arr;
        };

        $menu = json_decode(
            $this->getHelperData()->getMegaMenuConfig($storeId)
        );
        if (!$menu) {
            $menu = json_decode(
                $this->getHelperData()->getMegaMenuConfig()
            );
        }

        if (isset($menu[0])) {
            $menu = get_object_vars($menu[0]);
        }

        if (count($menu['children']) == 0) {
            return '';
        }

        $html = $this->_getHtml($menu['children'], $new_arr);

        return $html;
    }

    /**
     * @param $menus
     * @param $collection
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function _getHtml($menus, $collection)
    {
        $html = '';
        $i = 1;
        foreach ($menus as $menu) {
            if (!array_key_exists($menu->id, $collection)) {
                continue;
            }
            $menu2 = $collection[$menu->id];

            if (isset($menu->children[0])) {
                $childrenText = 'parent mynav';
            } else {
                $childrenText = '';
            }

            $checkIsFullWith = 0;

            if ($menu2['type'] == 2 || $menu2['type'] == 3) {
                $checkIsFullWith = 1;
            }

            $targetBlank = (isset($menu2['target_blank']) && $menu2['target_blank']) ? ' target="_blank" ' : '';
            $html .= '<li class="level0 dropdown '
                . ($checkIsFullWith == 1 ? 'bss-megamenu-fw ' : '')
                . 'level-top '.$childrenText.' 67577657 ui-menu-item">
                    <a class="level-top ui-corner-all" href="'
                        .$this->helper->getLinkUrl($menu2)
                    .'"'.$targetBlank.' ><span>'
                . $menu->text;
            if ($menu2['label'] != '') {
                $html .= $this->helper->getLabelColor($menu2['label']);
            }

            $html .= '</span></a>';

            switch ($menu2['type']) {
                case 1:
                    $html .= $this->_getChildHtmlDefault($menu, 0, $i, $collection);
                    break;

                case 2:
                    $html .= $this->_getChildHtmlCatagoryList($menu, $collection);
                    break;

                case 3:
                    $html .= $this->_getChildHtmlContent($menu, $collection);
                    break;
            }

            $html .= '</li>';
            $i++;
        }
        return $html;
    }

    /**
     * @param $menu
     * @param $level
     * @param $nav
     * @param $collection
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function _getChildHtmlDefault($menu, $level, $nav, $collection)
    {
        $html = '';
        if (count($menu->children) == 0) {
            return $html;
        }

        $countCollection = 0;
        foreach ($menu->children as $childrens) {
            if (array_key_exists($childrens->id, $collection)) {
                $countCollection++;
            }
        }

        if ($countCollection == 0) {
            return $html;
        }

        $html .= '<ul 
            class="dropdown-menu 123123123 fullwidth level0 submenu ui-menu ui-widget ui-widget-content ui-corner-all"
            role="menu">';
        $i = 1;
        $level++;
        foreach ($menu->children as $childrens) {
            if (!array_key_exists($childrens->id, $collection)) {
                continue;
            }

            $menu2 = $collection[$childrens->id];
            $html .= '<li class="dropdown-submenu level1 3453543534 nav-4-1 first ui-menu-item">
                    <a class="ui-corner-all"
                        href="'.$this->helper->getLinkUrl($menu2).'"><span>'.$childrens->text.'</span>';
            if ($menu2['label'] != '') {
                $html .= $this->helper->getLabelColor($menu2['label']);
            }
            $html .= '</a>';
            $nav_child = $nav.'-'.$i;
            if (isset($childrens->children[0])) {
                $html .= $this->_getChildHtmlDefault($childrens, $level, $nav_child, $collection);
            }
            $html .= '</li>';
            $i++;
        }
        $html .= '</ul>';
        return $html;
    }


    /**
     * @param $menu
     * @param $collection
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _getChildHtmlCatagoryList($menu, $collection)
    {
        $html = '';

        $countCollection = 0;
        foreach ($menu->children as $childrens) {
            if (array_key_exists($childrens->id, $collection)) {
                $countCollection++;
            }
        }

        $menu2 = $collection[$menu->id];

        if ($countCollection == 0
            && $menu2['block_top'] == ''
            && $menu2['block_left'] == ''
            && $menu2['block_bottom'] == ''
            && $menu2['block_right'] == ''
        ) {
            return $html;
        }
        $html .= '<div class="dropdown-menu"><div class="faux-column">';
        $html .= '<dl><dt>';

        if ($menu2['block_top'] != '') {
            $html .= '<div class="row">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_top'])
                ->toHtml();
            $html .= '</div><hr>';
        }

        $html .= '<div class="row">';

        $size = $this->helper->checkSize($menu2);

        if ($menu2['block_left'] != '') {
            $html .= '<div class="col-sm-'.$size.'">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_left'])
                ->toHtml();
            $html .= '</div>';
        }

        $html .= '<div class="col-sm-'.$size.'">';

        $html = $this->_getChildHtmlCatagoryListSecond($menu, $collection, $html, $menu2, $size, $countCollection);

        if ($menu2['block_bottom'] != '') {
            $html .= '<hr><div class="row">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_bottom'])
                ->toHtml();
            $html .= '</div>';
        }

        $html .= '</dt></dl>';
        $html .= '</div></div>';
        return $html;
    }

    /**
     * @param $menu
     * @param $collection
     * @param $html
     * @param $menu2
     * @param $size
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function _getChildHtmlCatagoryListSecond($menu, $collection, $html, $menu2, $size, $countCollection)
    {
        $columns = 1;
        if($menu->id && isset($collection[$menu->id])) {
            $currentItem = $collection[$menu->id];
            if(count($currentItem)) {
                if(isset($currentItem['columns_count']) && $currentItem['columns_count']) {
                    $columns = $currentItem['columns_count'];
                }
            }
        }

        $widthPercent = 100 / $columns;

        $childrensCounting = [];

        $allChildrensCountValue = 0;
        foreach ($menu->children as $childrens) {
            $childrenCount = $childrens->children;
            $allChildrensCountValue += count($childrenCount);
            $childrensCounting[$childrens->id] = count($childrenCount);
        }

        $allCount = array_sum($childrensCounting);
        $normalDistribution = ($allCount + count($childrensCounting)) / $columns;

        $columnsFinal = [];
        $currentNormalDistribution = 0;
        $currentColumn = 0;

        $checkAllParent = !array_sum($childrensCounting);
        if($checkAllParent) {
            foreach($childrensCounting as $menuId => $childrens) {
                $childrensCounting[$menuId] = 1;
            }
        }

        foreach ($childrensCounting as $menuId => $childrens) {

            $currentNormalDistribution += $childrens;
            if($currentNormalDistribution <= $normalDistribution) {
                if(!$currentColumn) {
                    $currentColumn = 1;
                }
                $columnsFinal[$menuId] = $currentColumn;
            } else {
                $columnsFinal[$menuId] = $currentColumn + 1;
                $currentColumn++;
                $currentNormalDistribution = 0;
            }
        }

        if($columnsFinal[$menuId] && $columnsFinal[$menuId] < $columns) {
            $sum = 0;
            $i = 0;
            foreach(array_reverse($childrensCounting) as $key => $item) {
                if(!$i) {
                    $columnsFinal[$key] = $columns;
                }
                $sum += $childrensCounting[$key];

                if($i && $sum < $normalDistribution && $columnsFinal[$key] != $columns - 2) {
                    $columnsFinal[$key] = $columns;
                }
                $i++;
            }
        }

        $i = 0;
        $openNewColumn = false;
        $currentCategory = $this->registry->registry('current_category');
        $parentsCategoriesIds = [];
        if($currentCategory) {
            foreach ($currentCategory->getParentCategories() as $parent) {
                $parentsCategoriesIds[] = $parent->getId();
            }
        }
        foreach ($menu->children as $childrens) {
            if (!array_key_exists($childrens->id, $collection)) {
                continue;
            }
            $parentActiveClass = '';
            if(
                $currentCategory && $currentCategory->getId() == $collection[$childrens->id]['category_id'] ||
                in_array($collection[$childrens->id]['category_id'], $parentsCategoriesIds)
            ) {
                $parentActiveClass = ' active-link ';
            }
            $currentColumn = $columnsFinal[$childrens->id];
            if(!$i || $openNewColumn) {
                $html .= '<div class="column-menu column-menu-'.$currentColumn.'" style="width: '.$widthPercent.'%;">';
            }

            $html .= '<a class="parent '.$parentActiveClass.' menu-link-'.$collection[$childrens->id]['category_id'].'" data-id="'.$collection[$childrens->id]['category_id'].'" href="'.$this->helper->getLinkUrl($collection[$childrens->id]).'" style="color:white">';
            $html .= $childrens->text;
            if ($collection[$childrens->id]['label'] != '') {
                $html .= $this->helper->getLabelColor($collection[$childrens->id]['label']);
            }
            $html .= '</a>';

            if (isset($childrens->children[0])) {
                $html .= '<ul>';
                foreach ($childrens->children as $child) {
                    if (!array_key_exists($child->id, $collection)) {
                        continue;
                    }
                    $activeClass = '';
                    if($currentCategory && $currentCategory->getId() == $collection[$child->id]['category_id']) {
                        $activeClass = ' active-link ';
                    }

                    $html .= '<li><a href="'.$this->helper->getLinkUrl($collection[$child->id]).'" class="children'.$activeClass.'" style="color:white"><span>';

                    $html .= $child->text;

                    $html .= '</span>';
                    if ($collection[$child->id]['label'] != '') {
                        $html .= $this->helper->getLabelColor($collection[$child->id]['label']);
                    }
                    $html .= '</a></li>';
                }
                $html .= '</ul>';
            }

            $nextItem = false;
            $nextColumnValue = 0;
            foreach($columnsFinal as $keyColumnFinal => $columnFinal) {
                if($nextItem) {
                    $nextColumnValue = $columnFinal;
                }
                if($keyColumnFinal == $childrens->id) {
                    $nextItem = true;
                }
            }

            if(($nextColumnValue && $nextColumnValue != $currentColumn) || ($i == count($columnsFinal) - 1)) {
                $html .= '</div>';
                $openNewColumn = true;
            } else {
                $openNewColumn = false;
            }

            $i++;
        }
        $html .= '</div>';

        if ($menu2['block_right'] != '') {
            $html .= '<div class="col-sm-'.$size.'">';
            $html .= $this->getLayout()->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_right'])->toHtml();
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }


    /**
     * @param $menu
     * @param $collection
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _getChildHtmlContent($menu, $collection)
    {
        $html = '';

        $menu2 = $collection[$menu->id];

        if ($menu2['block_top'] == ''
            && $menu2['block_left'] == ''
            && $menu2['block_bottom'] == ''
            && $menu2['block_right'] == ''
            && $menu2['block_content'] == ''
        ) {
            return $html;
        }

        $html .= '<ul class="dropdown-menu fullwidth"><li class="bss-megamenu-content">';

        if ($menu2['block_top'] != '') {
            $html .= '<div class="row">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_top'])
                ->toHtml();
            $html .= '</div><hr>';
        }

        $html .= '<div class="row">';

        $size = $this->helper->checkSize($menu2);

        if ($menu2['block_left'] != '') {
            $html .= '<div class="col-sm-'.$size.'">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_left'])
                ->toHtml();
            $html .= '</div>';
        }

        $html .= '<div class="col-sm-'.$size.'">';
        $html .= $this->getLayout()
            ->createBlock(\Magento\Cms\Block\Block::class)
            ->setBlockId($menu2['block_content'])
            ->toHtml();
        $html .= '</div>';

        if ($menu2['block_right'] != '') {
            $html .= '<div class="col-sm-'.$size.'">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_right'])
                ->toHtml();
            $html .= '</div>';
        }

        $html .= '</div>';

        if ($menu2['block_bottom'] != '') {
            $html .= '<hr><div class="row">';
            $html .= $this->getLayout()
                ->createBlock(\Magento\Cms\Block\Block::class)
                ->setBlockId($menu2['block_bottom'])
                ->toHtml();
            $html .= '</div>';
        }

        $html .= '</li></ul>';
        return $html;
    }
}
