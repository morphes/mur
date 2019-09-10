<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions\Plugins;

class ProductList
{
    /**
     * @var \Magento\Framework\View\Layout
     */
    protected $layout;

    public function __construct(
        \Magento\Framework\View\Layout $layout
    ) {
        $this->layout = $layout;
    }

    public function afterToHtml(
        \Magento\Catalog\Block\Product\ListProduct $subject,
        $result
    ){
        $aboveProductsNavBlock = $this->layout->getBlock('above_products.mana.layered_nav');
        if($aboveProductsNavBlock) {
            $result = $aboveProductsNavBlock->toHtml() . $result;
        }
        return $result;
    }
}