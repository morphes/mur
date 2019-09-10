<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\AdminUsefulLinks\Block\Links;

/**
 * Class Preview
 * @package Mageside\AdminUsefulLinks\Block\Links
 */

class Links extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var \Magento\Cms\Model\Page
     */
    private $page;

    /**
     * @var \Mageside\AdminUsefulLinks\Helper\Config
     */
    private $config;

    /**
     *
     * @var \Magento\Backend\Model\UrlInterface
     */
    private $urlBuilder;

    /**
     * Preview constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Cms\Model\Page $page
     * @param \Mageside\AdminUsefulLinks\Helper\Config $config
     * @param \Magento\Backend\Model\UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Cms\Model\Page $page,
        \Mageside\AdminUsefulLinks\Helper\Config $config,
        \Magento\Backend\Model\UrlInterface $urlBuilder,
        $data = []
    ) {
        $this->registry = $registry;
        $this->page = $page;
        $this->config = $config;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getEditLink()
    {
        $link = [];
        $storeId = $this->_storeManager->getStore()->getId();

        switch ($this->_nameInLayout) {
            case 'edit_category':
                $categoryId = $this->registry->registry('current_category')->getId();
                $link['url'] =  $this->_storeManager->getWebsite(0)->getDefaultStore()->getUrl(
                    'adminusefullinks/preview/links',
                    [
                        'store'     => $storeId,
                        'source'    => 'category',
                        'id'        => $categoryId
                    ]
                );
                $link['name'] = 'Edit Category';
                break;
            case 'edit_cms':
                $cmsId = $this->page->getId();
                $link['url'] =  $this->_storeManager->getWebsite(0)->getDefaultStore()->getUrl(
                    'adminusefullinks/preview/links',
                    [
                        'store'     => $storeId,
                        'source'    => 'cms',
                        'id'        => $cmsId
                    ]
                );
                $link['name'] = 'Edit CMS Page';
                break;
            default:
                $productId = $this->registry->registry('current_product')->getId();
                $link['url'] =  $this->_storeManager->getWebsite(0)->getDefaultStore()->getUrl(
                    'adminusefullinks/preview/links',
                    [
                        'store'     => $storeId,
                        'source'    => 'product',
                        'id'        => $productId
                    ]
                );
                $link['name'] = 'Edit Product';
        }
        return $link;
    }

    /**
     * @return bool
     * test module enable/disable
     */

    public function isEnabled()
    {
        return $this->config->isEnabled();
    }
}
