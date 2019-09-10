<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Controller\Adminhtml\UrlKey;

use Magento\Backend\App\AbstractAction;
use Magento\Framework\App\ResponseInterface;
use Magento\Backend\App\Action\Context;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Resources\UrlKeyResource;

class Save extends AbstractAction
{
    /**
     * @var UrlKeyResource
     */
    protected $resource;

    public function __construct(Context $context, UrlKeyResource $resource) {
        parent::__construct($context);
        $this->resource = $resource;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Manadev_Seo::url_key_save');
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        $id = $this->getRequest()->getParam('id');
        $redirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        try {
            $this->resource->edit($id, $data);
            $this->messageManager->addSuccess(__('URL key have been saved.'));
        }
        catch(\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
            $this->_getSession()->setFormData($data);

            return $redirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);
        }

        return $redirect->setPath('*/*/');
    }
}