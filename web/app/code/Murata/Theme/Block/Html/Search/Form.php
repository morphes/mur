<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE_EASYLIFE_BREADCRUMBS.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       GreenArt
 * @package        GreenArt_Breadcrumbs
 * @author         Stefan Iurasog
 * @email          office[at]green-art.ro
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
namespace Murata\Theme\Block\Html\Search;

class Form extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;

    private $placeholders = [
        'power_store_view' => 'Power Part Number Search',
        'wireless_store_view' => 'Wireless Part Number Search',
        'murataps_store_view' => 'Part Number Search',
    ];

    const WIRELESS_STORE_ID = 2;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getCurrentPlaceholder()
    {
        $storeCode = $this->_storeManager->getStore()->getCode();
        return (isset($this->placeholders[$storeCode])) ? $this->placeholders[$storeCode] : '';
    }

    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function wirelessStoreId()
    {
        return self::WIRELESS_STORE_ID;
    }
}