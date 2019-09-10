<?php
/** 
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface {

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        $db = $setup->getConnection();

        $tableName = 'mana_url_key';
        $db->addColumn($setup->getTable($tableName), 'filter_id', ['type' => Table::TYPE_BIGINT, 'nullable' => true, 'comment' => '..']);
        $db->addIndex($setup->getTable($tableName), $setup->getIdxName($tableName, ['filter_id']), ['filter_id']);
        $db->addForeignKey($setup->getFkName($tableName, 'filter_id', 'mana_filter', 'id'),
            $setup->getTable($tableName), 'filter_id', $setup->getTable('mana_filter'), 'id',
            Table::ACTION_CASCADE, Table::ACTION_CASCADE);

        $setup->endSetup();
    }
}