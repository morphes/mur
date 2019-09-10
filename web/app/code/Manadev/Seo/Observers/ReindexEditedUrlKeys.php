<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Observers;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Manadev\Core\Features;
use Manadev\Seo\Resources\IndexerResource;

class ReindexEditedUrlKeys implements ObserverInterface
{
    /**
     * @var IndexerResource
     */
    protected $indexerResource;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(IndexerResource $indexerResource, Features $features) {
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

        $ids = $observer->getData('ids');
        $this->indexerResource->reindexChangedUrlKeys($ids);
    }
}