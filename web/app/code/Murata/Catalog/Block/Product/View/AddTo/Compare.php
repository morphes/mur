<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Catalog\Block\Product\View\AddTo;

/**
 * Product view compare block
 *
 * @api
 * @since 101.0.1
 */
class Compare extends \Magento\Catalog\Block\Product\View\AddTo\Compare
{
    const MURATAPS_STORE_ID = 2;
    /**
     * Return compare params
     *
     * @return string
     * @since 101.0.1
     */
    public function getPostDataParams()
    {
        $product = $this->getProduct();
        return $this->_compareProduct->getPostDataParams($product);
    }

    public function isMurataPsStore()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->create('\Magento\Store\Model\StoreManagerInterface');
        return ($storeManager->getStore()->getId() == self::MURATAPS_STORE_ID);
    }
}
