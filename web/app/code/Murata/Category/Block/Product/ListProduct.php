<?php
namespace Murata\Category\Block\Product;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    const DC_DC_Converters = 11;
    const AC_DC_Power_Supplies = 12;
    const Micro_DC_DC_Converters = 45;
    const Digital_Panel_Meters = 16;
    const Digital_Panel_Meters_Accessories = 17;
    const Inductors = 14;
    const Pulse_Transformer = 19;
    const Current_Sensing_Transformer = 20;
    const Application_Specific_Transformer = 21;
    const Transformers = 15;
    const Common_Mode_Chokes = 13;
    const Series = 50;
    const RFM_Saw_Radios = 39;
    const RFM_Rfic_Radios = 37;
    const RFM_Resonators = 36;
    const RFM_Frequency_Control = 23;
    const RFM_Certified_Modules = 44;
    const RFM_LPWA = 48;
    const RFM_802154 = 46;
    const RFM_Cloud = 34;
    const RFM_M2M = 35;
    const RFM_WiFi_Bluetooth = 43;
    const RFM_Wi_Fi = 41;
    const RFM_IoT_System_On_Module = 49;
    const RFM_Bluetooth = 42;
    const RFM_Saw_Filter = 38;
    const Open_Compute = 51;

    const Wireless_Connectivity_Platforms = 229;

    const MURATAPS_STORE_ID = 2;
    const WIRELESS_STORE_ID = 3;

    const SEARCH_ROUTE_NAME = 'catalogsearch';

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getProductDetailsHtml(\Magento\Catalog\Model\Product $product)
    {
        $html = $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProduct($product)
            ->setTemplate('Murata_Category::tech-table.phtml')
            ->toHtml();
        $renderer = $this->getDetailsRenderer($product->getTypeId());
        if ($renderer) {
            $renderer->setProduct($product);
            return $html.$renderer->toHtml();
        }
        return '';
    }

    /**
     * @param $type
     */
    public function specTable($type, $product)
    {
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProduct($product)
            ->setTemplate('Murata_Category::spec/' . $type . '.phtml')
            ->toHtml();
    }

    /**
     * @param $type
     * @param $productCollection
     * @return mixed
     */
    public function productsTable($type, $productCollection)
    {
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProductCollection($productCollection)
            ->setTemplate('Murata_Category::products-table/' . $type . '.phtml')
            ->toHtml();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function statuses($product)
    {
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProduct($product)
            ->setTemplate('Murata_Category::statuses.phtml')
            ->toHtml();
    }

    /**
     * @return bool
     */
    public function isWireless($product)
    {
        $attributeSetId = $product->getAttributeSetId();

        if(in_array($attributeSetId, [
            self::RFM_Saw_Radios,
            self::RFM_Rfic_Radios,
            self::RFM_Resonators,
            self::RFM_Frequency_Control,
            self::RFM_Certified_Modules,
            self::RFM_LPWA,
            self::RFM_802154,
            self::RFM_Cloud,
            self::RFM_M2M,
            self::RFM_WiFi_Bluetooth,
            self::RFM_Wi_Fi,
            self::RFM_IoT_System_On_Module,
            self::RFM_Bluetooth,
            self::RFM_Saw_Filter
        ])) {
            return true;
        }

        return false;
    }

    public function gridTable($_productCollection)
    {
        $storeTheme = ($this->getStoreId() == self::WIRELESS_STORE_ID) ? 'wireless-theme' : '';
        $gridTableTemplate = 'Murata_Category::' . $storeTheme . '/product/grid-table.phtml';
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProductCollection($_productCollection)
            ->setTemplate($gridTableTemplate)
            ->toHtml();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function wirelessStatuses($product)
    {
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProduct($product)
            ->setTemplate('Murata_Category::wireless-statuses.phtml')
            ->toHtml();
    }

    public function specButtons($product)
    {
        return $this->getLayout()->createBlock('Magento\Catalog\Block\Product\ListProduct')
            ->setProduct($product)
            ->setTemplate('Murata_Category::spec/buttons.phtml')
            ->toHtml();
    }

    public function getLoadedProductCollection()
    {
        return $this->_getProductCollection()->addAttributeToSelect('*');
    }

    public function isWirelessConnectivityPlatforms()
    {
        return $this->getLayer()->getCurrentCategory()->getId() == self::Wireless_Connectivity_Platforms;
    }

    private function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function isMurataPs()
    {
        return ($this->getStoreId() == self::MURATAPS_STORE_ID);
    }

    public function isSearchPage()
    {
        return ($this->getRequest()->getRouteName() == self::SEARCH_ROUTE_NAME);
    }
}