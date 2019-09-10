<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Observers;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Indexer\IndexerRegistry;
use Manadev\Core\Features;
use Manadev\Seo\Resources\IndexerResource;

class ReindexEditedCategories implements ObserverInterface
{
    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;
    /**
     * @var IndexerResource
     */
    protected $indexerResource;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(IndexerRegistry $indexerRegistry, IndexerResource $indexerResource,
        Features $features)
    {
        $this->indexerRegistry = $indexerRegistry;
        $this->indexerResource = $indexerResource;
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

        $indexer = $this->indexerRegistry->get('mana_url_rewrite');
        if (!$indexer->isScheduled()) {
            $categoryId = $observer->getData('data_object')->getId();
            $rewriteIds = $this->indexerResource->getUrlRewriteIdsByCategoryId($categoryId);
            if (!empty($rewriteIds)) {
                $indexer->reindexList($rewriteIds);
            }
        }
    }
}