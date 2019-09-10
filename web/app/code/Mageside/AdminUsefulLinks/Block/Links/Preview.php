<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\AdminUsefulLinks\Block\Links;

/**
 * Class Links
 * @package Mageside\AdminUsefulLinks\Block\Links
 */

class Preview extends \Magento\Framework\View\Element\Template
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
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Preview constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Cms\Model\Page $page
     * @param \Mageside\AdminUsefulLinks\Helper\Config $config
     * @param \Magento\Backend\Model\UrlInterface $urlBuilder
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Cms\Model\Page $page,
        \Mageside\AdminUsefulLinks\Helper\Config $config,
        \Magento\Backend\Model\UrlInterface $urlBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $data = []
    ) {
        $this->registry = $registry;
        $this->page = $page;
        $this->config = $config;
        $this->urlBuilder = $urlBuilder;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getEditLink()
    {
        $link = [];
        $params = $this->getRequest()->getParams();
        $link['source'] = $params['source'];

        switch ($params['source']) {
            case 'category':
                $link['url'] = $this->urlBuilder->getUrl(
                    'catalog/category/edit',
                    [
                        'id'    => $params['id'],
                        'key'   => ''
                    ]
                );
                break;
            case 'cms':
                $link['url'] = $this->urlBuilder->getUrl(
                    'cms/page/edit',
                    [
                        'page_id'   => $params['id'],
                        'key'       => ''
                    ]
                );
                break;
            default:
                $link['url'] = $this->urlBuilder->getUrl(
                    'catalog/product/edit',
                    [
                        'id'    => $params['id'],
                        'key'   => ''
                    ]
                );
        }
        return $link;
    }

    public function isEnabled()
    {
        return $this->config->isEnabled();
    }

    public function getBackendUrl()
    {
        return $this->urlBuilder->getUrl('admin/dashboard/index');
    }
}
