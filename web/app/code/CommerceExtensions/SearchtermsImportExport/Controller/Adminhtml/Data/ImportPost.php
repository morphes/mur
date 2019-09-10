<?php
/**
 * Copyright © 2015 CommerceExtensions. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace CommerceExtensions\SearchtermsImportExport\Controller\Adminhtml\Data;

use Magento\Framework\Controller\ResultFactory;

class ImportPost extends \CommerceExtensions\SearchtermsImportExport\Controller\Adminhtml\Data
{
    /**
     * import action from import/export url rewrites
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        if ($this->getRequest()->isPost() && $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'import_rates_file'])) {
            try {
				$params = $this->getRequest()->getParams();
                $importHandler = $this->_objectManager->create('CommerceExtensions\SearchtermsImportExport\Model\Data\CsvImportHandler');
                $importHandler->importFromCsvFile($this->getRequest()->getFiles('import_rates_file'), $params);

                $this->messageManager->addSuccess(__('Search Terms have been imported.'));
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Invalid file upload attempt'));
            }
        } else {
            $this->messageManager->addError(__('Invalid file upload attempt'));
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRedirectUrl());
        return $resultRedirect;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(
            'CommerceExtensions_SearchtermsImportExport::import_export'
        );

    }
}
