<?php

/**
 * Copyright © 2015 CommerceExtensions. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace CommerceExtensions\SearchtermsImportExport\Model\Data;

use Magento\Framework\App\ResourceConnection;

/**
 *  CSV Import Handler
 */
 
class CsvImportHandler
{ 
	/**
     * Resource instance
     *
     * @var Resource
     */
    protected $resource;

    /**
     * Search Terms factory
     *
     * @var \Magento\Search\Model\QueryFactory
     */
    protected $queryFactory;

    /**
     * CSV Processor
     *
     * @var \Magento\Framework\File\Csv
     */
    protected $csvProcessor;

    /**
     * @param \Magento\UrlRewrite\Model\UrlRewriteFactory $rewriteFactory
     * @param \Magento\Framework\File\Csv $csvProcessor
     */
    public function __construct(
        ResourceConnection $resource,
		\Magento\Search\Model\QueryFactory $queryFactory,
        \Magento\Framework\File\Csv $csvProcessor
    ) {
        // prevent admin store from loading
        $this->resource = $resource;
        $this->queryFactory = $queryFactory;
        $this->csvProcessor = $csvProcessor;
    }

    /**
     * Retrieve a list of fields required for CSV file (order is important!)
     *
     * @return array
     */
    public function getRequiredCsvFields()
    {
        // indexes are specified for clarity, they are used during import
        return [
            0 => __('query_text'),
            1 => __('num_results'),
            2 => __('popularity'),
            3 => __('redirect'),
            4 => __('synonym_for'),
            5 => __('store_id'),
            6 => __('display_in_terms'),
            7 => __('is_active'),
            8 => __('is_processed'),
            9 => __('updated_at')
        ];
    }

    /**
     * Import Data from CSV file
     *
     * @param array $file file info retrieved from $_FILES array
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function importFromCsvFile($file, $params)
    {
        if (!isset($file['tmp_name'])) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid file upload attempt.'));
        }
		
		if($params['import_delimiter'] != "") { $this->csvProcessor->setDelimiter($params['import_delimiter']); }
		if($params['import_enclose'] != "") { $this->csvProcessor->setEnclosure($params['import_enclose']); }
		
        $RawData = $this->csvProcessor->getData($file['tmp_name']);
        // first row of file represents headers
        $fileFields = $RawData[0];
        $ratesData = $this->_filterData($fileFields, $RawData);
       
        foreach ($ratesData as $dataRow) {
            $this->_importSearchterms($dataRow, $params);
        }
    }


    /**
     * Filter data (i.e. unset all invalid fields and check consistency)
     *
     * @param array $RawDataHeader
     * @param array $RawData
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
     protected function _filterData(array $RawDataHeader, array $RawData)
    {
		$rowCount=0;
		$RawDataRows = array();
        #$validFieldsNum = count($validFields);
        foreach ($RawData as $rowIndex => $dataRow) {
			// skip headers
            if ($rowIndex == 0) {
				if(!in_array("query_text", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "query_text" NOT FOUND'));
				}
				if(!in_array("popularity", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "popularity" NOT FOUND'));
				}
				if(!in_array("store_id", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "store_id" NOT FOUND'));
				}
				if(!in_array("display_in_terms", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "display_in_terms" NOT FOUND'));
				}
				if(!in_array("is_active", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "is_active" NOT FOUND'));
				}
				if(!in_array("is_processed", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "is_processed" NOT FOUND'));
				}
				if(!in_array("updated_at", $dataRow)) {
                	throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: REQUIRED FIELD "updated_at" NOT FOUND'));
				}
                continue;
            }
            // skip empty rows
            if (count($dataRow) <= 1) {
                unset($RawData[$rowIndex]);
                continue;
            }
			/* we take rows from [0] = > value to [website] = base */
            if ($rowIndex > 0) {
				foreach ($dataRow as $rowIndex => $dataRowNew) {
					try {
						$RawDataRows[$rowCount][$RawDataHeader[$rowIndex]] = $dataRowNew;
					}
					catch (\Exception $e) { 
						throw new \Magento\Framework\Exception\LocalizedException(__("CHECK CSV DELIMITER SETTINGS AND/OR CSV FORMAT. CSV CANNOT BE PARSED"), $e);
					}
				}
			}
			$rowCount++;
        }
        return $RawDataRows;
    }


    /**
     * Import Search Terms
     *
     * @param array $Data
     * @param array $storesCache cache of stores related to tax rate titles
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _importSearchterms(array $Data, array $params)
    {
			$searchTermModel = $this->queryFactory->create();
			$query = $searchTermModel->loadByQuery($Data['query_text']);
			if (!$query->getId()) {
				if($Data['query_text']!="") { $searchTermModel->setQueryText($Data['query_text']); }
				if(isset($Data['num_results'])) { $searchTermModel->setNumResults($Data['num_results']); }
				if($Data['popularity']!="") { $searchTermModel->setPopularity($Data['popularity']); }
				if($Data['redirect']!="") { $searchTermModel->setRedirect($Data['redirect']); }
				if(isset($Data['synonym_for'])) { $searchTermModel->setSynonymFor($Data['synonym_for']); }
				if($Data['store_id']!="") { $searchTermModel->setStoreId($Data['store_id']); }
				if($Data['display_in_terms']!="") { $searchTermModel->setDisplayInTerms($Data['display_in_terms']); }
				if($Data['is_active']!="") { $searchTermModel->setIsActive($Data['is_active']); }
				if($Data['is_processed']!="") { $searchTermModel->setIsProcessed($Data['is_processed']); }
				if($Data['updated_at']!="") { $searchTermModel->setUpdatedAt($Data['updated_at']); }
		
				try {
					$searchTermModel->save();
				} catch (\Exception $e) {
					throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: '. $e->getMessage()));
				}
				
		   } else {
				if($params['delete_searchterms_on_match'] == "true") { 	
					try {
						$query->delete();
					} catch (\Exception $e) {
						throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: '. $e->getMessage()));
					}
				} else {
					if(isset($Data['num_results'])) { $query->setNumResults($Data['num_results']); }
					$query->setPopularity($Data['popularity']);
					$query->setRedirect($Data['redirect']);
					if(isset($Data['synonym_for'])) { $query->setSynonymFor($Data['synonym_for']); }
					$query->setStoreId($Data['store_id']);
					$query->setDisplayInTerms($Data['display_in_terms']);
					$query->setIsActive($Data['is_active']);
					$query->setIsProcessed($Data['is_processed']);
					$query->setUpdatedAt($Data['updated_at']);
					try {
						$query->save();
					} catch (\Exception $e) {
						throw new \Magento\Framework\Exception\LocalizedException(__('ERROR: '. $e->getMessage()));
					}
				}
		  }
			
    }
}