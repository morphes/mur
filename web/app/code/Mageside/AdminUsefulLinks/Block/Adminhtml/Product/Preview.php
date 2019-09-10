<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

namespace Mageside\AdminUsefulLinks\Block\Adminhtml\Product;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Framework\Registry;
use Magento\Framework\Url;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\AuthorizationInterface;
use Mageside\AdminUsefulLinks\Helper\Config as HelperConfig;

/**
 * Class Preview
 * @package Mageside\AdminUsefulLinks\Block\Adminhtml\Product
 */
class Preview extends Generic
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;
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
     * @param Context $context
     * @param Registry $registry
     * @param Url $urlBuilder
     * @param AuthorizationInterface $authorization
     * @param HelperConfig $helperConfig
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Url $urlBuilder,
        AuthorizationInterface $authorization,
        HelperConfig $helperConfig
    ) {
        $this->authorization = $authorization;
        $this->helperConfig = $helperConfig;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $registry);
    }

    /**
     * @return array
     * generate 'Preview' button
     */

    public function getButtonData()
    {
        if ($this->canShowButton() && $this->helperConfig->isEnabled()) {
            $url = $this->urlBuilder->getBaseUrl() . 'catalog/product/view/id/' . $this->getProduct()->getId();

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
        return $this->authorization->isAllowed('Mageside_AdminUsefulLinks::previewProducts');
    }
}
