<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

namespace Mageside\AdminUsefulLinks\Block\Adminhtml\Page\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\AuthorizationInterface;
use Mageside\AdminUsefulLinks\Helper\Config as HelperConfig;

/**
 * Class Preview
 * @package Mageside\AdminUsefulLinks\Block\Adminhtml\Page\Edit
 */
class Preview extends \Magento\Backend\Block\Template implements ButtonProviderInterface
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
     * @param AuthorizationInterface $authorization
     * @param HelperConfig $helperConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        AuthorizationInterface $authorization,
        HelperConfig $helperConfig,
        array $data = []
    ) {
        $this->authorization = $authorization;
        $this->helperConfig = $helperConfig;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     * generate 'Preview' button
     */
    public function getButtonData()
    {
        if ($this->canShowButton() && $this->helperConfig->isEnabled()) {
            $page_id = $this->getRequest()->getParam('page_id');
            $url = $this->getBaseUrl() . 'cms/page/view/page_id/' . $page_id;

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
        return $this->authorization->isAllowed('Mageside_AdminUsefulLinks::previewPage');
    }
}
