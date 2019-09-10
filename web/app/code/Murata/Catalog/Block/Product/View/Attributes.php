<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Product description block
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Murata\Catalog\Block\Product\View;

use Magento\Catalog\Model\Product;
use Magento\Framework\Phrase;
use Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * @api
 * @since 100.0.2
 */
class Attributes extends \Magento\Catalog\Block\Product\View\Attributes
{
    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    protected $_groupCollection;

    protected $_wirelessAttributeGroups = [
        'Specs',
        'Documents',
        'Software',
        'Block Diagram',
        'Eval Tool',
        'Applications',
        'FAQ',
        'Purchase'
    ];

    const DISCOUNTIED_STATUS = 'Discontinued';

    const WIRELESS_DESCRIPTION = 'rfm_paragraph';

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        PriceCurrencyInterface $priceCurrency,
        array $data = [],
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory $_groupCollection
    ) {
        $this->_groupCollection = $_groupCollection;
        parent::__construct($context, $registry, $priceCurrency, $data);
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    /**
     * $excludeAttr is optional array of attribute codes to
     * exclude them from additional data array
     *
     * @param array $excludeAttr
     * @return array
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function getAdditionalData(array $excludeAttr = [])
    {
        $data = [];
        $product = $this->getProduct();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            if ($attribute->getIsVisibleOnFront() && !in_array($attribute->getAttributeCode(), $excludeAttr)) {
                $value = $attribute->getFrontend()->getValue($product);

                if ($value instanceof Phrase) {
                    $value = (string)$value;
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = $this->priceCurrency->convertAndFormat($value);
                }

                if (is_string($value) && strlen($value)) {
                    $data[$attribute->getAttributeCode()] = [
                        'label' => __($attribute->getStoreLabel()),
                        'value' => $value,
                        'code' => $attribute->getAttributeCode(),
                    ];
                }
            }
        }
        return $data;
    }

    public function getAttributesGroups()
    {
        $product = $this->getProduct();
        $groupCollection = $this->_groupCollection->create();
        $groupCollection->addFieldToFilter('attribute_set_id', $product->getAttributeSetId());
        $attributesGroupsIds = [];
        foreach($groupCollection as $attributeGroup) {
            foreach($this->_wirelessAttributeGroups as $wagId => $wagName) {
                if($wagId >= 0 && $attributeGroup->getAttributeGroupName() == $wagName) {
                    $attributesGroupsIds[$attributeGroup->getAttributeGroupId()] = $wagName;
                }
            }
        }
        $attributesGroupsIds['-1'] = 'Description';

        $attributes = $product->getAttributes();

        $filteredGroups = [];
        foreach($attributes as $attribute)
        {
            foreach(array_keys($attributesGroupsIds) as $groupId) {
                if($groupId < 0 && $attribute->getAttributeCode() == self::WIRELESS_DESCRIPTION) {
                    $filteredGroups[$attributesGroupsIds[$groupId]] = [$attribute->getFrontend()->getValue($product)];
                } else {
                    if ($attribute->isInGroup($product->getAttributeSetId(), $groupId)) {
                        if ($attribute->getFrontend()->getValue($product)) {
                            $filteredGroups[$attributesGroupsIds[$groupId]][$attribute->getFrontendLabel()] =
                                $attribute->getFrontend()->getValue($product);
                        }
                    }
                }
            }
        }
        return $filteredGroups;
    }
}
