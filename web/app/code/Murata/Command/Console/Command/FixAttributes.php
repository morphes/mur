<?php

namespace Murata\Command\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class FixAttributes extends Command
{
    const ATTRIBUTE_NAME = 'attribute';

    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ) {
        $this->state = $state;
        $this->_productCollectionFactory = $productCollectionFactory;
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
        $this->setName('fix:attributes');
        $this->setDescription('Fix Dublicates Values');
        $commandoptions = [new InputOption(self::ATTRIBUTE_NAME, null, InputOption::VALUE_REQUIRED, self::ATTRIBUTE_NAME)];
        $this->setDefinition($commandoptions);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(!($attribudeId = $input->getOption(self::ATTRIBUTE_NAME))) {
            $output->writeln('You must specify attribute id (for example --attribute=150)');
            exit;
        }

        $objectManager  = \Magento\Framework\App\ObjectManager::getInstance();
        $imageProcessor = $objectManager->create('Magento\Catalog\Model\Product\Gallery\Processor');
        $productFactory = $objectManager->get('\Magento\Catalog\Model\ProductFactory');

        $resource      = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection    = $resource->getConnection();
        $attributesIds = [$attribudeId];
        foreach ($attributesIds as $attributeId) {
            $sql    = "SELECT *
                  FROM eav_attribute_option_value AS a
                  INNER JOIN eav_attribute_option AS ao USING (option_id)
                  INNER JOIN (
                    SELECT b.store_id, b.value_id, b.value, b.option_id, bo.attribute_id
                    FROM eav_attribute_option_value AS b
                    INNER JOIN eav_attribute_option AS bo USING (option_id)
                  ) AS b ON ao.attribute_id = b.attribute_id
                WHERE
                  a.value_id != b.value_id
                  AND a.store_id = b.store_id
                  AND a.value = b.value
                  AND b.attribute_id=
            ".$attributeId;
            $result = $connection->fetchAll($sql);
            $forDelete = [];
            foreach($result as $res) {
                $collection = $this->_productCollectionFactory->create();
                $collection->addAttributeToSelect('*');
                $collection->addAttributeToFilter('operating_temperature_range', $res['option_id']);
                if(!$collection->count()) {
                    $forDelete[$res['option_id']] = $collection->count();
                }
            }
            foreach($forDelete as $optionId => $count) {
                $connection->query('DELETE FROM eav_attribute_option_value WHERE option_id='.$optionId);
                $connection->query('DELETE FROM eav_attribute_option WHERE option_id='.$optionId);
            }
        }


    }

}
