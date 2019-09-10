<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Controller\Adminhtml\UrlKey;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends AbstractAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, Registry $registry) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->context = $context;
        $this->registry = $registry;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Manadev_Seo::url_keys');
    }

    public function execute() {
        $id = $this->context->getRequest()->getParam('id');

        /* @var $urlKey \Manadev\Seo\Models\UrlKey */
        $urlKey = $this->_objectManager->create('Manadev\Seo\Models\UrlKey');
        $urlKey->load($id);

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);

        if (!empty($data)) {
            $urlKey->addData($data);
        }

        $this->registry->register('urlKey', $urlKey);

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Manadev_Seo::url_keys');
        $resultPage->getConfig()->getTitle()->prepend((__("'%1' - %2 - URL Key",
            $urlKey->getData('url_key'), $urlKey->getData('description'))));

        return $resultPage;
    }
}