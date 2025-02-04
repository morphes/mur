<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category   BSS
 * @package    Bss_CmsPageImportExport
 * @author     Extension Team
 * @copyright  Copyright (c) 2017-2018 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\CmsPageImportExport\Controller\Adminhtml\Export;

class Index extends \Magento\ImportExport\Controller\Adminhtml\Export\Index
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = parent::execute();
        $resultPage->getLayout()->getBlock('menu')->setActive('Bss_CmsPageImportExport::importexport_cms_page_export');
        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_CmsPageImportExport::importexport_cms_page_export');
    }
}
