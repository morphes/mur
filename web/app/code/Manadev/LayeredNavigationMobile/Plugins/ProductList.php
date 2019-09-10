<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationMobile\Plugins;

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
//        $mobileNavBlock = $this->layout->getBlock('mobile.mana.layered_nav');
//        if($mobileNavBlock) {
//            $result = $mobileNavBlock->toHtml() . $result;
//        }
        return $result;
    }
}