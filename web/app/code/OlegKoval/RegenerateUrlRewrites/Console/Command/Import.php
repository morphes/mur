<?php
/**
 * Regenerate Url rewrites
 *
 * @package OlegKoval_RegenerateUrlRewrites
 * @author Oleg Koval <contact@olegkoval.com>
 * @copyright 2018 Oleg Koval
 * @license OSL-3.0, AFL-3.0
 */

namespace OlegKoval\RegenerateUrlRewrites\Console\Command;

use SoapClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Import extends Command
{
    public function __construct(\Magento\Framework\App\State $state)
    {
        $this->state = $state;
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
        $this->setName('products:import');
        $this->setDescription('Import products');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $productFactory = $objectManager->create('Magento\Catalog\Model\ProductRepository');
//        foreach([151, 165, 163, 164, 234, 153, 155, 152, 228, 231, 232] as $categoryId) {
//            $cateinstance = $objectManager->create('Magento\Catalog\Model\CategoryFactory');
//
//            $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
//            $collection = $productCollection->create();
//            $collection->addAttributeToSelect('*');
//            $collection->addCategoriesFilter(['in' => $categoryId]);
//            $collection->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
//            $collection->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
//            foreach($collection as $product) {
//                $product        = $productFactory->getById($product->getId());
//
//                if($product->getData('rfm_dimension_length') || $product->getData('rfm_dimension_width') || $product->getData('rfm_dimension_height')) {
//                    $product->setData('rfm_dimension_length', '');
//                    $product->setData('rfm_dimension_width', '');
//                    $product->setData('rfm_dimension_height', '');
//                    $product->save();
//                }
//
//
//            }
//
//        }
//        die();












//
//        $mps       = $this->mps();
//        $idsToSkus = [];
//        foreach (explode(',', $mps) as $skuId) {
//            $skuToId = explode('--', $skuId);
//            if (count($skuToId) == 2) {
//                $idsToSkus[$skuToId[0]] = $skuToId[1];
//            }
//        }

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);


        $news           = $objectManager->create('MageArray\News\Model\Newspost');
        $newsFactory    = $objectManager->create('MageArray\News\Model\NewspostFactory');
        $now            = date('Y-m-d');
        $post           = $newsFactory->create();
        $postCollection = $post->getCollection()
            ->setActiveFilter(true)
            ->setPostFilter()
//            ->addFieldToFilter('content', ['like' => '%template%'])
            ->addFieldToFilter('content', ['like' => '%product="%']);
        $productsIds    = [];


        $postCount=count($postCollection);
        $current = 0;
        $ids = [];
        foreach ($postCollection as $post) {

            $allParts = [];
            $test1 = explode('product="', $post['content']);
            foreach($test1 as $tst) {
                $test2 = explode('"}}', $tst);
                foreach($test2 as $tst2) {
                    $allParts[] = $tst2;
                }
            }
            foreach($allParts as $allPart) {
                if(is_numeric($allPart)) {
                    $ids[] = $allPart;
                }
            }
            $content = $post['content'];
            foreach($ids as $id) {
//                $output->writeln('------'.$id);
                if(isset($idsToSkus[$id])) {
//                    $content = str_replace('product="'.$id.'"', 'product="'.$idsToSkus[$id].'"', $content);
                } else {
//                    $output->writeln('-----------' . $id);
                }
            }
//            die();
//
//            $parts   = [];
//            $content = explode('[product id="', $post['content']);
//            foreach ($content as $c) {
//                $cel = explode('" template="wordpress/shortcode/custom-product.phtml"]', $c);
//                foreach ($cel as $cl) {
//                    $parts[] = $cl;
//                }
//            }
//$pIds = [];
//            foreach ($parts as $part) {
//                if (is_numeric($part)) {
//                    $pIds[] = $part;
//                }
//            }
//            var_dump($pIds);
//            die();
//            $content = str_replace('[product id="', '{{widget type="MageArray\News\Block\Widget\Product" product="', $post['content']);
//            $content = str_replace('" template="wordpress/shortcode/custom-product.phtml"]', '"}}', $content);
//            foreach($pIds as $productId) {
//                if($productId == 9563) {
//                    die('--------');
//                }
//                if(isset($idsToSkus[$productId])) {
//                    $content = str_replace('product="'.$productId.'"', 'product="'.$idsToSkus[$productId].'"', $content);
//                } else {
//                    $output->writeln('-----------' . $productId);
//                }
//            }
//            $news->load($post['newspost_id']);
//            $news->setContent($content);
//            $news->save();
//            $current++;
//            $output->writeln($current.'/'.$postCount);
        }
//        if ($type == 'mps') {
            $url = 'http://mps1:8888/index.php/api/soap/?wsdl';
//        }
//        if ($type == 'power') {
//            $url = 'http://power1:8888/index.php/api/soap/?wsdl';
//        }
        $client  = new SoapClient($url, array("trace" => 1, "exception" => 0));
        $session = $client->login('sazon', 'everest1024');
        $productFactory       = $objectManager->get('\Magento\Catalog\Model\ProductFactory');
        $atrributesRepository = $objectManager->create('\Magento\Catalog\Model\Product\Attribute\Repository');

        $values = $this->getAttributeValues($atrributesRepository, 'series');
        $productF = $objectManager->create('Magento\Catalog\Model\ProductRepository');
        foreach($ids as $id) {
            $productApi = $this->productApi($client, $session, $id, 'mps');
            $productSite = $productFactory->create()->setStoreId(2)->loadByAttribute('sku', $id);
            if($productSite && $productSite->getAttributeText('series') != $productApi['series']) {

                if(isset($values[$productApi['series']])) {

//                        $productSite = $productFactory->create()->setStoreId($storeId)->loadByAttribute('sku', $id);

//                    }
                    foreach ([0, 1, 2, 3, 4] as $storeId) {
                        $objectManager->get('Magento\Catalog\Model\Product\Action')
                            ->updateAttributes([$productSite->getId()], ['series' => $values[$productApi['series']]], $storeId);
                    }
//                    $productSite = $productF->getById($productSite->getId());
//                    var_dump($productSite->getId());
//                    die();
//                    var_dump($productSite->getSeries());
//                        $productSite->setSeries($values[$productApi['series']]);
//                    var_dump($productSite->getSeries());
//                        var_dump($productSite->getSeries());
//                        die();
//                        $productSite->save();

//var_dump($values[$productApi['series']]);
//                    var_dump($productSite->getSku());
//                    die();
                } else {
                    var_dump($productApi['series']);
                    die();
                }
//                var_dump($productSite->getAttributeText('series'));
//                var_dump($productApi['series']);
//                var_dump($productSite->getSku());
//                die();
            }
        }
echo "<pre>";
print_r($ids);
die();
        die();
        $productsIds = array_unique($productsIds);
        print_r(implode("','", $productsIds));
        die();
        echo "<pre>";

        die();
        var_dump($postCollection->getSelect()->__toString());
        var_dump($postCollection->count());
        die();


        $productFactory = $objectManager->create('Magento\Catalog\Model\ProductRepository');
        $product        = $productFactory->getById(9563);
        die(var_dump($product->getId()));


        $eavConfig         = $objectManager->create('Magento\Eav\Model\Config');
        $attribute         = $eavConfig->getAttribute('catalog_product', 'rfm_platform');
        $options           = $attribute->getSource()->getAllOptions();
        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        foreach ($options as $option) {
            $count = 0;
            if ($option['value']) {
                foreach ([0, 1, 2, 3, 4] as $storeId) {
                    $collection = $productCollection->create()->setStoreId($storeId)->addAttributeToSelect('*');
                    $collection->addAttributeToFilter('rfm_platform', $option['value'])->load();
                    if ($collection->count()) {
                        $count++;
                    }
                }
            }
            if (!$count) {
                echo 'Delete label : ' . $option['label'] . PHP_EOL;
                $options['delete'][$option['value']] = true;
                $options['value'][$option['value']]  = true;
                $eavSetup                            = $objectManager->get('\Magento\Eav\Setup\EavSetup');
                $eavSetup->addAttributeOption($options);
            }
            $count = 0;
        }
        die('----');


        $output->writeln('Start');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);

        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        $collection        = $productCollection->create()->setStoreId('3')->addAttributeToSelect('*');
        $collection->addAttributeToFilter('rfm_platform', 6355)->load();
        echo $collection->getSelect()->__toString();
        var_dump($collection->count());
        var_dump($collection->getFirstItem()->getSku());
        die();



        $type                 = 'power';
        $objectManager        = \Magento\Framework\App\ObjectManager::getInstance();
        $productFactory       = $objectManager->get('\Magento\Catalog\Model\ProductFactory');
        $productAction        = $objectManager->get('Magento\Catalog\Model\Product\Action');

        if ($type == 'mps') {
            $url = 'http://mps1:8888/index.php/api/soap/?wsdl';
        }
        if ($type == 'power') {
            $url = 'http://power1:8888/index.php/api/soap/?wsdl';
        }
        $client  = new SoapClient($url, array("trace" => 1, "exception" => 0));
        $session = $client->login('sazon', 'everest1024');

        $productList = $this->productList($client, $session, $type);

//        foreach($productList as $key => $product) {
//            if(in_array($product['sku'], $this->powerProducts())) {
//                unset($productList[$key]);
//            }
//        }
//        var_dump(count($productList));

        $skus = [];
        foreach ($productList as $product) {
            $skus[] = $product['sku'];
        }

        $allCount     = count($productList);
        $currentCount = 0;
        foreach ($productList as $product) {
//            print_r($product);
//            die();
            $start      = microtime(true);
            $productSku = $product['sku'];
//            $productSku = '8999889';
            if ($currentCount > 1364) {
                $productApi = $this->productApi($client, $session, $productSku, $type);
                unset($productApi['product_id']);
                unset($productApi['sku']);
                unset($productApi['set']);
                unset($productApi['type']);
                unset($productApi['categories']);
                unset($productApi['websites']);
                unset($productApi['type_id']);
                unset($productApi['name']);
                unset($productApi['description']);
                unset($productApi['short_description']);
                unset($productApi['status']);
                unset($productApi['old_id']);
                unset($productApi['url_key']);
                unset($productApi['url_path']);
                unset($productApi['required_options']);
                unset($productApi['has_options']);
                unset($productApi['created_at']);
                unset($productApi['updated_at']);
                unset($productApi['price']);
                unset($productApi['special_price']);
                unset($productApi['special_from_date']);
                unset($productApi['special_to_date']);
                unset($productApi['tier_price']);
                unset($productApi['msrp_display_actual_price_type']);
                unset($productApi['msrp_enabled']);
                unset($productApi['msrp_display_actual_price_type']);
                unset($productApi['minimal_price']);
                unset($productApi['msrp']);
                unset($productApi['tax_class_id']);
                unset($productApi['recurring_profile']);
                unset($productApi['gift_message_available']);
                unset($productApi['weight']);
                unset($productApi['news_from_date']);
                unset($productApi['news_to_date']);
                unset($productApi['image_label']);
                unset($productApi['small_image_label']);
                unset($productApi['thumbnail_label']);
                unset($productApi['category_ids']);
                unset($productApi['options_container']);
                unset($productApi['page_layout']);
//                echo "<pre>";
//                var_dump($productSku);
                $productSite = $productFactory->create()->setStoreId(2)->loadByAttribute('sku', $productSku);
//                print_r($productSite->getData());
//                var_dump($productSite->getData('p_tran_turn_ratio'));
//                die();
                /*foreach ($productSite->getWebsiteIds() as $websiteId) {
                    $productSite->setData('output_power_total_w', 23);
                    $productSite->setData('total_output_power_w', 5501);
                    $productSite->save();
                }
                die();*/
//           die();
                if ($productSite) {

//                            $productSite = $productFactory->create()->setStoreId($websiteId)->loadByAttribute('sku', $productSku);
//                            if ($productApi['visibility'] == 'Catalog, Search' && $productSite->getVisibility() == 3) {
//                                $output->writeln('-----------&&&&&&&&' . $productSku);
//                                $productApi['visibility'] = 'Search';
//                            }
                    $attrs_values = [];
                    foreach ($productApi as $attr => $value) {
                        if (!$value) {
                            $value = '';
                        } else {
                            $values = $this->getAttributeValues($atrributesRepository, $attr);
                            if (!$values) {

                            } else {
                                if ($values && isset($values[$value])) {
                                    $value = $values[$value];
                                } else {
                                    if ($values) {
                                        if (!isset($values[$value])) {
                                            $this->createOrGetId($atrributesRepository, $attr, $value);
                                            $values = $this->getAttributeValues($atrributesRepository, $attr);
                                            if ($values && isset($values[$value])) {
                                                $value = $values[$value];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $attrs_values[$attr] = $value;
                    }
                    $forSaving = [];
                    foreach ($attrs_values as $attr => $value) {
                        if ($productSite->getData($attr) != $value) {
                            $forSaving[$attr] = $value;
                        }
                    }
                    if (!$productSite->getPrice()) {
                        $forSaving['price'] = '0.01';
                    }
//                    $productSite = $productFactory->create()->loadByAttribute('sku', $productSku);
                    $websiteIds   = $productSite->getWebsiteIds();
                    $websiteIds[] = 0;
//                    var_dump($websiteIds);
//                    die();
//echo "<Pre>";
//                    print_r($forSaving);
//                    die();
                    if (count($forSaving)) {
                        $output->writeln(json_encode($forSaving));
                        foreach ([0, 1, 2, 3, 4] as $websiteId) {
                            $productAction->updateAttributes([$productSite->getId()], $attrs_values, $websiteId);
                        }
                    }
//                    die();
                }
            }
            $output->writeln($productSku);
            $output->writeln($currentCount . '/' . $allCount);
            $currentCount++;
            $output->writeln("Save product duration: " . (microtime(true) - $start) . " seconds");
        }
        echo "<pre>";
        print_r($productList);
        die();
    }

    function productList($client, $session, $type)
    {
        try {
            $result = $client->call($session, 'catalog_product.list');
        } Catch (\SoapFault $e) {
            return [];
        } Catch (Exception $e) {
            return [];
        }
        return $result;
    }

    public function createOrGetId($atrributesRepository, $attributeCode, $label)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attribute_id  = $atrributesRepository->get($attributeCode)->getAttributeId();

        $languageValues[0] = $label;
        $languageValues[1] = $label;
        $languageValues[2] = $label;
        $languageValues[3] = $label;

        $attr = $objectManager->create('\Magento\Eav\Model\Entity\Attribute');
        $attr->load($attribute_id);

        $option                          = array();
        $option['value'][$attributeCode] = $languageValues;
        $attr->addData(array('option' => $option));

        $attr->save();
    }


    public function getAttributeValues($atrributesRepository, $attributeCode)
    {
        if (isset($this->attrsLibrary[$attributeCode])) {
            return $this->attrsLibrary[$attributeCode];
        }
        $manufacturerOptions = $atrributesRepository->get($attributeCode)->getOptions();
        $values              = array();
        foreach ($manufacturerOptions as $manufacturerOption) {
            if (gettype($manufacturerOption->getLabel()) == 'object') {
                $values[$manufacturerOption->getLabel()->getText()] = $manufacturerOption->getValue();  // Label
            } else {
                $values[$manufacturerOption->getLabel()] = $manufacturerOption->getValue();  // Label
            }
        }
        $this->attrsLibrary[$attributeCode] = $values;
        return $values;
    }

    function productApi($client, $session, $sku, $type)
    {
        try {
            $result = $client->call($session, 'catalog_product.info', $sku);
        } Catch (\SoapFault $e) {
            return [];
        } Catch (Exception $e) {
            return [];
        }
        return $result;
    }

    function powerProducts()
    {
        return [];
    }

    function mps()
    {
        return '9563--8999984,1777--8944000,588--8170151,708--8903574,729--8903603,733--8903653,769--8904511,831--8907011,1015--8914463,1167--8921531,1449--8933057,1451--8933059,1726--8941098,1727--8941099,1728--8941100,1732--8941104,1744--8941158,1746--8941202,1758--8941220,1760--8941236,1765--8941242,1766--8941243,1768--8941245,1770--8941247,1774--8941251,1783--8944010,2119--8971267,2122--8971271,2154--8980026,2181--8981062,2204--8999051,2922--MEA1D4815SC,2942--MER1S4815SC,2986--MEV3S1215SC,2998--MTU1S1215MC,3030--NCS6S4815C,3063--NDTD0503C,3079--NDTS0503C,3385--NMG1215SC,3420--NMJ0505SAC,3752--NTF2415MC,4560--C1U-W-1200-12-TC2C,4566--C1U-W-1200-48-TC2C,4572--D1U-H-2800-52-HB1DC,4579--D1U-W-1200-48-HA1C,4595--D1U-W-2000-48-HA2C,4601--D1U4-W-1200-12-HC2C,4605--D1U4-W-1600-12-HC2C,4607--4401699-6,4632--S1U-3X-16-A-12-RC,4825--50474C,4827--11R102C,4862--12LRS682C,4866--12RS103C,4883--13R152C,4961--15102C,5065--19R472C,5090--22R156MC,5216--28102C,5238--29102C,5257--29L102C,5276--32100C,5289--33100C,5305--34122C,5323--34L122C,5338--35251C,5345--36401C,5375--42132C,5382--43212C,5394--45281C,5415--46281C,5435--471R0SC,5465--481R0SC,5495--491R0SC,5523--82102C,5540--84102C,5857--8078634,5958--8900202,5963--8900207,5968--8922052,5972--8922056,6005--8922212,6223--8942186,6228--8942229,6300--8978647,6301--8978648,6339--8941259,6341--8941160,6346--8937105,6352--8903761,6376--8999320,6378--8941400,6398--8981072,6406--MEE3S1215SC,6415--4401722-3,6418--8900232,6419--51504C,6423--52305C,6427--53020C,6437--54050C,6440--55050C,6444--782482/53VC,6445--37301C,6458--38L322C,6485--39S602C,6502--27472C,6517--27T102C,6533--83421C,6550--60A582C,6561--60B473C,6571--8808635,7095--8903137,7107--8980203,7147--8980075,7164--8921552,7182--8941407,7184--8941403,7186--8941409,7188--8941405,7232--8900161,7329--MEE1S2415DC,7345--8999431,7380--8941416,7394--RUW15SL24HC,7412--8999417,7414--8999479,7416--8957300,7420--8999377,7459--8957401,7472--8999544,7487--30201AC,7489--30101BC,7525--MTE1S2415MC,7574--MEJ1D1205SC,7597--8922540,7598--8922500,7601--8808638,7604--8808642,7617--NCS12D4812C,7622--4401802-1,7624--8401755,7632--MEU1S0509ZC,7644--8957425,7645--8941420,7647--8941292,7660--8983368,7678--8983364,7696--MEF1S2405SP3C,7697--8941421,7715--8808500,7717--8808508,7719--8808505,7728--8808647,7730--NCS1S1203SC,7753--8999527,7767--8903171,7775--MTU2D1212MC,7817--NCM6S4815EC,7829--MGJ2D242005SC,7853--4401793-3,7877--4401820-1,7880--OKDX-T/40-W12-001-C,7892--OKDX-T/50-W12-001-C,7894--MGJ3T12150505MC,7898--MGJ6T24150505MC,7899--NXE1S0505MC,7926--8999612,7961--8999684,7971--8921569,7972--4401822-1,7974--4401823-1,7979--OKDX-T/20-W12-001-C,7981--OKDY-T/25-W12-001-C,7988--4401852-1,7991--8999494,7992--8941464,8035--4401809-1,8036--NMUSB202MC,8042--MTC1S2412MC,8043--8941475,8044--8941476,8045--8941477,8051--NXJ1S1215MC,8166--NCS3S4815SC,8168--4401876-1,8169--4401877-1,8174--NXE1S0305MC,8175--OKDL-T/6-W12-001-C,8176--OKDL-T/12-W12-001-C,8177--OKDL-T/18-W12-001-C,8178--D2U5T-H3-5000-380-HU3C,8180--8922600,8181--8999830,8215--8999758,8217--8999767,8235--8952017,8255--NXE2S1215MC,8256--8922570,8262--MTC2S2412MC,8284--4401894-2,8287--4401903-1,8298--MGJ1D241905MPC,8324--MGJ6D052005LMC,8330--8808735,8343--OKDL-T/60-W12-001-C,8348--8808729,8359--8808718,8376--8808706,8377--MGJ6D12H24MC,8379--MGJ6Q12P24MC,8382--MGJ6T24F24MC,8389--NM485D6S5MC,8390--NMTTLD6S5MC,8392--8807054,8397--4401726-1,9349--PQC250-48,9354--8978304,9436--8999836,9443--8941525,9445--NMUSB2022PMC,9449--8999937,9479--8999846,9489--MGJ6D241505WMC,9559--NXF1S0505MC,9572--8999977,9599--8999854,9624--782100/55JVC-R,9653--8978800';
    }
}
