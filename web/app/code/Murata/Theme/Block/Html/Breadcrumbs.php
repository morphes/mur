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

namespace Murata\Theme\Block\Html;

/**
 * Class Breadcrumbs
 *
 * @package GreenArt\Breadcrumbs\Block\Html
 */

use Magento\Framework\View\Element\Template;

class Breadcrumbs extends \Magento\Theme\Block\Html\Breadcrumbs
{
    protected $_template = 'Murata_Theme::html/header/breadcrumbs.phtml';

    protected $_storeManager;

    const MURATA_LINK = 'https://www.murata.com/';
    const MURATA_PRODUCTS_LINK = 'https://www.murata.com/products';
    const MURATA = 'murata';
    const MURATA_STORE_VIEW = 'murataps_store_view';

    private $placeholders = [
        'power_store_view'    => 'Products',
        'wireless_store_view' => 'Products',
        'murataps_store_view' => 'Products',
        'murata'              => 'Murata'
    ];

    private $placeholdersSecond = [
        'power_store_view'    => 'Power',
        'wireless_store_view' => 'Wireless',
        'murataps_store_view' => 'Products'
    ];

    public function __construct(
        Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function murataCrumbs($crumbs)
    {
        if (!$crumbs) {
            return [];
        }
        $checkOperatingRequirenment = false;
        foreach($crumbs as $name => $crumb) {
            if($name == 'cms_page' && $crumb['title'] = 'Operating Requirements' && $crumb['last']) {
                $checkOperatingRequirenment = true;
            }
        }
        if($checkOperatingRequirenment) {
            $cmsCrumbs = [];
            foreach($crumbs as $name => $crumb) {
                if($name == 'cms_page') {
                    $tmpCrumb = [];
                    $tmpCrumb['link']             = 'support.html';
                    $tmpCrumb['label']            = 'Support';
                    $tmpCrumb['title']            = 'Support';
                    $cmsCrumbs[] = $tmpCrumb;
                    $cmsCrumbs[] = $crumb;
                } else {
                    $cmsCrumbs[] = $crumb;
                }
            }
            return $cmsCrumbs;
        }

        $murataCrumbs = [];

        $lastCrumb = '';
        foreach($crumbs as $crumbName => $crumbInfo) {
            if(gettype($crumbInfo['label']) == 'string') {
                $lastCrumb = $crumbInfo['label'];
            }
        }
        if(in_array($lastCrumb, [
            'Power Products',
            'Wireless Products',
            'Murata Products'
        ])) {
            foreach ($crumbs as $crumbName => $crumbInfo) {
                if ($crumbName == 'home') {
                    $crumbInfo['link']   = self::MURATA_LINK;
                    $crumbInfo['target'] = true;
                }

                if ($this->_storeManager->getStore()->getId() != 2) {
                    if ($placeholderCode = $this->_checkPlaceholders($crumbInfo['label'])) {
                        $crumbMurata                     = $crumbInfo;
                        $crumbMurata['link']             = self::MURATA_PRODUCTS_LINK;
                        $crumbMurata['label']            = $this->placeholders[$placeholderCode];
                        $crumbMurata['target']           = true;
                        $murataCrumbs['murata_products'] = $crumbMurata;

                    }
                    $murataCrumbs[$crumbName] = $crumbInfo;
                }
            }
            return $murataCrumbs;
        }

        foreach ($crumbs as $crumbName => $crumbInfo) {
            if ($crumbName == 'home') {
                $crumbInfo['link']   = self::MURATA_LINK;
                $crumbInfo['target'] = true;
            }


            if ($this->_storeManager->getStore()->getId() != 2) {
                if ($placeholderCode = $this->_checkPlaceholders($crumbInfo['label'])) {
                    $crumbMurata                     = $crumbInfo;
                    $crumbMurata['link']             = self::MURATA_PRODUCTS_LINK;
                    $crumbMurata['label']            = $this->placeholders[$placeholderCode];
                    $crumbMurata['target']           = true;
                    $murataCrumbs['murata_products'] = $crumbMurata;
                    if ($crumbInfo['label'] == '3D') {

                    } else {
                        if ($crumbName == 'category113') {
                            $crumbInfo['label'] = 'Wireless';
                        } elseif ($crumbName == 'category40') {
                            $crumbInfo['label'] = 'Power';
                        } else {
                            if (
                                $crumbInfo['label'] != 'Power Products' &&
                                $crumbInfo['label'] != 'Wireless Products' &&
                                $crumbInfo['label'] != 'Murata Products'
                            ) {
                                $crumbInfo['label'] = 'Power';
                            }
                        }
                    }
                }
                $murataCrumbs[$crumbName] = $crumbInfo;
            } else {
                return $crumbs;
            }

        }

        return $murataCrumbs;
    }

    private function _checkPlaceholders($label)
    {
        if ($label == '3D') {
            return $this->_storeManager->getStore()->getCode();
        }
        if (explode(' ', $label) == 2) {
            return false;
        }
        foreach ($this->placeholders as $placeholderKey => $placeholderName) {
            if ($label == $placeholderName && $this->_storeManager->getStore()->getCode() == self::MURATA_STORE_VIEW) {
                return self::MURATA;
            }
            if (
                strpos($label, $placeholderName) !== false &&
                $this->_storeManager->getStore()->getCode() == $placeholderKey &&
                count(explode(' ', $label)) == 2
            ) {
                return $placeholderKey;
            }
        }
        return false;
    }

}