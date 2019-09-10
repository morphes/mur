<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Indexers;

use Manadev\Seo\Indexer;

class AttributeIndexer extends Indexer
{

    /**
     * Execute materialization on ids entities
     *
     * @param int[] $ids
     * @return void
     * @api
     */
    public function execute($ids) {
        $this->resource->reindexChangedAttributes($ids);
    }
}