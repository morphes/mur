<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        if (version_compare($context->getVersion(), '2') < 0) {
            $setup->startSetup();
            $db = $setup->getConnection();

            $tableName = 'mana_config_history';
            $table = $db->newTable($setup->getTable($tableName))
                ->addColumn('id', Table::TYPE_BIGINT, null,
                    ['identity' => true, 'nullable' => false, 'primary' => true])
                ->addColumn('scope', Table::TYPE_TEXT, 8, ['nullable' => false, 'default' => 'default'])
                ->addColumn('scope_id', Table::TYPE_INTEGER, null, ['nullable' => false, 'default' => '0'])
                ->addColumn('path', Table::TYPE_TEXT, 255, ['nullable' => false, 'default' => 'general'])
                ->addColumn('value', Table::TYPE_TEXT, '64k')
                ->addIndex($setup->getIdxName('core_config_data', ['scope', 'scope_id', 'path']),
                    ['scope', 'scope_id', 'path'])
            ;
            $db->createTable($table);

            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '3') < 0) {
            $setup->startSetup();
            $db = $setup->getConnection();

            $tableName = 'mana_url_key_conflict_resolution';
            $table = $db->newTable($setup->getTable($tableName))
                ->addColumn('id', Table::TYPE_BIGINT, null,
                    ['identity' => true, 'nullable' => false, 'primary' => true])

                ->addColumn('scope', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->addIndex($setup->getIdxName($tableName, ['scope']), ['scope'])

                ->addColumn('url_key', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->addIndex($setup->getIdxName($tableName, ['scope', 'url_key']), ['scope', 'url_key'], ['type' => 'unique'])

                ->addColumn('store_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false])
                ->addIndex($setup->getIdxName($tableName, ['store_id']), ['store_id'])
                ->addForeignKey($setup->getFkName($tableName, 'store_id', 'store', 'store_id'),
                    'store_id', $setup->getTable('store'), 'store_id',
                    Table::ACTION_CASCADE, Table::ACTION_CASCADE)

                ->addColumn('last_used_resolution', Table::TYPE_TEXT, 20, ['nullable' => false])
            ;
            $db->createTable($table);

            $setup->endSetup();
        }
    }
}