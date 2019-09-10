<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Murata\Category\Block\Product\ProductList;

use Magento\Catalog\Helper\Product\ProductList;
use Magento\Catalog\Model\Product\ProductList\Toolbar as ToolbarModel;

/**
 * Product list toolbar
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 100.0.2
 */
class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{
    /**
     * session order getter
     */
    private function _getSessionOrder()
    {
        return $this->_catalogSession->getSortOrder();
    }

    /**
     * session order getter
     */
    private function _getSessionDirection()
    {
        return $this->_catalogSession->getSortDirection();
    }

    /**
     * Get grit products sort order field
     *
     * @return string
     */
    public function getCurrentOrder()
    {
        $order = $this->_getData('_current_grid_order');
        if ($order) {
            return $order;
        }

        $orders = $this->getAvailableOrders();
        $defaultOrder = $this->getOrderField();

        if (!isset($orders[$defaultOrder])) {
            $keys = array_keys($orders);
            $defaultOrder = $keys[0];
        }

        $order = $this->_toolbarModel->getOrder();
        if (!$order || !isset($orders[$order])) {
            $order = $defaultOrder;
        }

        if ($order != $defaultOrder) {
            $this->_memorizeParam('sort_order', $order);
        }
        if(!isset($_GET['product_list_order']) && $this->_getSessionOrder() && $order != $this->_getSessionOrder() && !($order != $defaultOrder)) {
            return $this->_getSessionOrder();
        }
        $this->setData('_current_grid_order', $order);
        return $order;
    }

    /**
     * Retrieve current direction
     *
     * @return string
     */
    public function getCurrentDirection()
    {
        $dir = $this->_getData('_current_grid_direction');
        if ($dir) {
            return $dir;
        }
        $directions = ['asc', 'desc'];
        $dir = strtolower($this->_toolbarModel->getDirection());
        if (!$dir || !in_array($dir, $directions)) {
            $dir = $this->_direction;
        }

        if ($dir != $this->_direction) {
            $this->_memorizeParam('sort_direction', $dir);
        }
        if(!isset($_GET['product_list_dir']) && $this->_getSessionDirection() && $dir != $this->_getSessionDirection() && !($dir != $this->_direction)) {
            return $this->_getSessionDirection();
        }
        $this->setData('_current_grid_direction', $dir);
        return $dir;
    }
}
