<?php

namespace Murata\ExportPower\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DailyExportPower extends Command
{
    private $_objectManager;
    private $statuses = [
        'To Be Discontinued'            => 'C',
        'to be discontinued'            => 'C',
        'Recommended In Production'     => 'B',
        'recommended in production'     => 'B',
        'In Production'                 => 'B',
        'in production'                 => 'B',
        'Discontinued'                  => 'D',
        'discontinued'                  => 'D',
        'Under Development'             => 'A',
        'under development'             => 'A',
        'under development recommended' => 'A'
    ];

    public function __construct(\Magento\Framework\App\State $state)
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->state          = $state;
        parent::__construct();
    }

    /**
     * @var null|Symfony\Component\Console\Input\InputInterface
     */
    protected $_input = null;

    /**
     * @var null|Symfony\Component\Console\Output\OutputInterface
     */
    protected $_output = null;

    protected function configure()
    {
        $this->setName('murata:exportpower');
        $this->setDescription('Murata Power Daily Export');

        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);

        $storeManager = $this->_objectManager->create('Magento\Store\Model\StoreManagerInterface');
        $dir          = $this->_objectManager->get('\Magento\Framework\App\Filesystem\DirectoryList');
        $appDirectory = $dir->getRoot();

        $productsMps = $productsWireless = $productsPower = [];
        foreach ($storeManager->getStores() as $store) {
            if (in_array($store->getStoreId(), [1])) {
                $productCollection = $this->_getProductCollection($store->getStoreId());
                foreach ($productCollection as $product) {
                    if (
                        strpos($product->getSku(), 'series') === false &&
                        strpos($product->getSku(), 'Series') === false &&
                        strpos($product->getSku(), '3d model') === false &&
                        strpos($product->getName(), '3d model') === false
                    ) {
                        $statusName = 'product_status';
                        $output->writeln($product->getAttributeText('product_status'));
                        $output->writeln($product->getAttributeText('rfm_product_status'));
                        if ($product->getAttributeText($statusName)) {
                            $status       = $this->statuses[$product->getAttributeText($statusName)];
                            $statusNumber = ($product->getAttributeText($statusName) == 'Recommended In Production') ? 1 : 0;
                            $url          = 'https://power.murata.com/' . $product->getUrlPath() . '.html';
                            $row          = [];
                            $row[]        = '"' . $product->getName() . '"';
                            $row[]        = '"' . $product->getSku() . '"';
                            $row[]        = '"' . $status . '"';
                            $row[]        = '"' . $statusNumber . '"';
                            $row[]        = '""';
                            $row[]        = '"' . $url . '"';
//                            $row[]        = '"' . $product->getUpdatedAt() . '"';
//                            $row[]        = '"' . $product->getCreatedAt() . '"';
                            $row[]        = '""';

                            if ($store->getStoreId() == 2) {
                                $productsMps[] = $row;
                            } elseif ($store->getStoreId() == 3) {
                                $productsWireless[] = $row;
                            } elseif ($store->getStoreId() == 1) {
                                $productsPower[] = $row;
                            }
                        }
                    }
                }
            }
        }

        $fp = fopen($appDirectory . '/export_power_products_processed.csv', 'w');

        foreach ($productsPower as $fields) {
            fputcsv($fp, $fields, ',', chr(127));
        }

        fclose($fp);
    }

    private function _getProductCollection($storeId)
    {
        $productCollection = $this->_objectManager->create(
            'Magento\Catalog\Model\ResourceModel\Product\Collection'
        );
        $productCollection->addAttributeToSelect('*');
        $productCollection->addStoreFilter($storeId);
        $productCollection->load();
        return $productCollection;
    }
}

