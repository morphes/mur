<?php
/**
 * Copyright © 2015 CommerceExtensions. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace CommerceExtensions\SearchtermsImportExport\Controller\Adminhtml\Data;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Resource;

class ExportPost extends \CommerceExtensions\SearchtermsImportExport\Controller\Adminhtml\Data
{ 
	/**
     * Resource instance
     *
     * @var Resource
     */
    protected $resource;
	/**
     * Write connection adapter
     *
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connection;
    /**
     * Export action from import/export tax
     *
     * @return ResponseInterface
     */
   
    public function execute()
    {
		$params = $this->getRequest()->getParams();
		$resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');
		$productMetadata = $this->_objectManager->get('Magento\Framework\App\ProductMetadataInterface');
		$connection = $resource->getConnection();
		$search_query = $resource->getTableName('search_query');
		
		if($params['export_delimiter'] != "") {
			$delimiter = $params['export_delimiter'];
		} else {
			$delimiter = ",";
		}
		if($params['export_enclose'] != "") {
			$enclose = $params['export_enclose'];
		} else {
			$enclose = "\"";
		}
        /** start csv content and set template */
        $headers = new \Magento\Framework\DataObject(
            [
                'query_text' => __('query_text'),
                'num_results' => __('num_results'),
                'popularity' => __('popularity'),
                'redirect' => __('redirect'),
                'synonym_for' => __('synonym_for'),
                'store_id' => __('store_id'),
                'display_in_terms' => __('display_in_terms'),
                'is_active' => __('is_active'),
                'is_processed' => __('is_processed'),
                'updated_at' => __('updated_at')
            ]
        );
		
		if($productMetadata->getVersion()>= "2.1.2") {
			$headers->unsetData("synonym_for");
			$headers->unsetData("num_results");
        	$template = ''.$enclose.'{{query_text}}'.$enclose.''.$delimiter.''.$enclose.'{{popularity}}'.$enclose.''.$delimiter.''.$enclose.'{{redirect}}'.$enclose.''.$delimiter.''.$enclose.'{{store_id}}'.$enclose.''.$delimiter.''.$enclose.'{{display_in_terms}}'.$enclose.''.$delimiter.''.$enclose.'{{is_active}}'.$enclose.''.$delimiter.''.$enclose.'{{is_processed}}'.$enclose.''.$delimiter.''.$enclose.'{{updated_at}}'.$enclose.'';
		} else {
        	$template = ''.$enclose.'{{query_text}}'.$enclose.''.$delimiter.''.$enclose.'{{num_results}}'.$enclose.''.$delimiter.''.$enclose.'{{popularity}}'.$enclose.''.$delimiter.''.$enclose.'{{redirect}}'.$enclose.''.$delimiter.''.$enclose.'{{synonym_for}}'.$enclose.''.$delimiter.''.$enclose.'{{store_id}}'.$enclose.''.$delimiter.''.$enclose.'{{display_in_terms}}'.$enclose.''.$delimiter.''.$enclose.'{{is_active}}'.$enclose.''.$delimiter.''.$enclose.'{{is_processed}}'.$enclose.''.$delimiter.''.$enclose.'{{updated_at}}'.$enclose.'';
		}
		
        $content = $headers->toString($template);
        $content .= "\n";
        
		$query = "SELECT query_id FROM ".$search_query."";
		$searchtermsCollection = $connection->fetchAll($query);
		foreach ($searchtermsCollection as $row) {
			$_searchtermModel = $this->_objectManager->create('Magento\Search\Model\Query')->load($row['query_id']);
            $content .= $_searchtermModel->toString($template) . "\n";
		}
        
        return $this->fileFactory->create('export_search_terms.csv', $content, DirectoryList::VAR_DIR);
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
