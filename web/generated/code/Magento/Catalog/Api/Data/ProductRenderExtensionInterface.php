<?php
namespace Magento\Catalog\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Catalog\Api\Data\ProductRenderInterface
 */
interface ProductRenderExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\Catalog\Api\Data\ProductRender\ButtonInterface|null
     */
    public function getWishlistButton();

    /**
     * @param \Magento\Catalog\Api\Data\ProductRender\ButtonInterface $wishlistButton
     * @return $this
     */
    public function setWishlistButton(\Magento\Catalog\Api\Data\ProductRender\ButtonInterface $wishlistButton);
}
