<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo;

use Magento\Framework\Mview\ActionInterface as MviewInterface;
use Magento\Framework\Indexer\ActionInterface as IndexerInterface;
use Manadev\Core\Exceptions\NotSupported;
use Manadev\Seo\Resources\IndexerResource;

abstract class Indexer implements IndexerInterface, MviewInterface
{
    /**
     * @var IndexerResource
     */
    protected $resource;

    public function __construct(IndexerResource $resource) {
        $this->resource = $resource;
    }

    /**
     * Execute materialization on ids entities
     *
     * @param int[] $ids
     * @return void
     * @api
     */
    abstract public function execute($ids);

    /**
     * Execute full indexation
     *
     * @return void
     */
    public function executeFull() {
        $this->resource->reindexAll();
    }

    /**
     * Execute partial indexation by ID list
     *
     * @param int[] $ids
     * @return void
     * @throws NotSupported
     */
    public function executeList(array $ids) {
        $this->execute($ids);
    }

    /**
     * Execute partial indexation by ID
     *
     * @param int $id
     * @return void
     * @throws NotSupported
     */
    public function executeRow($id) {
        $this->execute([$id]);
    }
}