<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

namespace Mageside\AdminUsefulLinks\Block\Adminhtml\Category;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;
use Magento\Framework\AuthorizationInterface;
use Mageside\AdminUsefulLinks\Helper\Config as HelperConfig;

/**
 * Class Preview
 * @package Mageside\AdminUsefulLinks\Block\Adminhtml\Category
 */
class Preview extends AbstractCategory implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    private $authorization;

    /**
     * @var HelperConfig
     */
    private $helperConfig;

    /**
     * Preview constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Category\Tree $categoryTree
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param AuthorizationInterface $authorization
     * @param HelperConfig $helperConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\Tree $categoryTree,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        AuthorizationInterface $authorization,
        HelperConfig $helperConfig,
        array $data = []
    ) {
        $this->authorization = $authorization;
        $this->helperConfig = $helperConfig;
        parent::__construct($context, $categoryTree, $registry, $categoryFactory, $data);
    }

    /**
     * @return array
     * generate 'Preview' button
     */

    public function getButtonData()
    {
        if ($this->canShowButton() && $this->helperConfig->isEnabled()) {
            $category = $this->getCategory();
            $url = $this->getBaseUrl() . 'catalog/category/view/id/' . $category->getId();

            return [
                'id' => 'preview',
                'label' => __('Preview'),
                'on_click' => "window.open('{$url}')",
                'class' => 'preview',
                'sort_order' => 1
            ];
        } else {
            return [];
        }
    }

    private function canShowButton()
    {
        return $this->authorization->isAllowed('Mageside_AdminUsefulLinks::previewCategory');
    }
}
