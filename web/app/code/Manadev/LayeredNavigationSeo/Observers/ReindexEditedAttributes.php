<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Observers;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\UrlRewrite\Model\UrlRewrite;
use Manadev\Core\Features;

class ReindexEditedAttributes implements ObserverInterface
{
    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(IndexerRegistry $indexerRegistry, Features $features) {
        $this->indexerRegistry = $indexerRegistry;
        $this->features = $features;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return;
        }

        $indexer = $this->indexerRegistry->get('mana_url_attribute');
        if (!$indexer->isScheduled()) {
            $attributeId = $observer->getData('data_object')->getId();
            $indexer->reindexRow($attributeId);
        }
    }
}