<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Configuration
{
    const EXPAND_ALL_ON_INITIAL_LOAD = "mana_layered_navigation/category_tree/expand_all_on_initial_load";
    const EXPAND_SELECTED = "mana_layered_navigation/category_tree/expand_selected";
    const SHOW_SIBLING_IF_NO_CHILD = "mana_layered_navigation/category_tree_parents_children/show_sibling_if_no_child";
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isExpandAllItemsOnInitialLoad() {
        return $this->scopeConfig->isSetFlag(self::EXPAND_ALL_ON_INITIAL_LOAD);
    }

    public function isExpandSelected() {
        return $this->scopeConfig->isSetFlag(self::EXPAND_SELECTED);
    }

    public function isShowSiblingIfNoChild() {
        return $this->scopeConfig->isSetFlag(self::SHOW_SIBLING_IF_NO_CHILD);
    }
}