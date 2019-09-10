<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Indexers;

use Manadev\Seo\Indexer;

class UrlRewriteIndexer extends Indexer
{

    /**
     * Execute materialization on ids entities
     *
     * @param int[] $ids
     * @return void
     * @api
     */
    public function execute($ids) {
        $this->resource->reindexChangedUrlRewrites($ids);
    }
}