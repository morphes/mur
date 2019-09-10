<?php

namespace Murata\Catalog\Controller\Product\Compare;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Catalog\Controller\Product\Compare;

class Add extends \Magento\Catalog\Controller\Product\Compare\Add
{
    /**
     * Add item to compare list
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $productId = (int)$this->getRequest()->getParam('product');

        if(!$productId) {
            $productsIds = explode(',', $this->getRequest()->getParam('productsIds'));
        } else {
            $productsIds = [$productId];
        }

        foreach($productsIds as $productId) {
            if ($productId && ($this->_customerVisitor->getId() || $this->_customerSession->isLoggedIn())) {
                $storeId = $this->_storeManager->getStore()->getId();
                try {
                    $product = $this->productRepository->getById($productId, false, $storeId);
                } catch (NoSuchEntityException $e) {
                    $product = null;
                }

                if ($product) {
                    $this->_catalogProductCompareList->addProduct($product);
                    $productName = $this->_objectManager->get(
                        \Magento\Framework\Escaper::class
                    )->escapeHtml($product->getName());
                    $this->messageManager->addSuccess(__('You added product %1 to the comparison list.', $productName));
                    $this->_eventManager->dispatch('catalog_product_compare_add_product', ['product' => $product]);
                }

                $this->_objectManager->get(\Magento\Catalog\Helper\Product\Compare::class)->calculate();
            }
        }
        if($productId) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setRefererOrBaseUrl();
        }
        exit;
    }
}
