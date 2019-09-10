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
namespace Murata\CatalogSearch\Block\SearchResult;

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
        '-1' => 'Description',
        '503' => 'Specs',
        '502' => 'Documents',
        '500' => 'Software',
        '499' => 'Block Diagram',
        '498' => 'Eval Tool',
        '501' => 'Applications',
        '497' => 'Purchase'
    ];

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
        $attributes = $product->getAttributes();

        $filteredGroups = [];
        foreach($attributes as $attribute)
        {
            foreach(array_keys($this->_wirelessAttributeGroups) as $groupId) {
                if($groupId < 0 && $attribute->getAttributeCode() == self::WIRELESS_DESCRIPTION) {
                    $filteredGroups[$this->_wirelessAttributeGroups[$groupId]] = [$attribute->getFrontend()->getValue($product)];
                } else {
                    if ($attribute->isInGroup($product->getAttributeSetId(), $groupId)) {
                        if ($attribute->getFrontend()->getValue($product)) {
                            $filteredGroups[$this->_wirelessAttributeGroups[$groupId]][$attribute->getFrontendLabel()] =
                                $attribute->getFrontend()->getValue($product);
                        }
                    }
                }
            }
        }
        return $filteredGroups;
    }
}
