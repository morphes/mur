<?php
/** 
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Setup;

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
        $table = $db->newTable($setup->getTable($tableName))

            //
            // ID, foreign keys and infrastructure
            //

            ->addColumn('id', Table::TYPE_BIGINT, null,
                ['identity' => true, 'nullable' => false, 'primary' => true])

            ->addColumn('url_key', Table::TYPE_TEXT, 255, ['nullable' => true])
            ->addIndex($setup->getIdxName($tableName, ['url_key']), ['url_key'])

            ->addColumn('status', Table::TYPE_TEXT, 20, ['nullable' => false])
            ->addIndex($setup->getIdxName($tableName, ['status']), ['status'])

            ->addColumn('position', Table::TYPE_INTEGER, null, ['nullable' => false])

            ->addColumn('type', Table::TYPE_TEXT, 20, ['nullable' => false])

            ->addColumn('sub_type', Table::TYPE_TEXT, 30, ['nullable' => false])

            ->addColumn('store_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false])
            ->addIndex($setup->getIdxName($tableName, ['store_id']), ['store_id'])
            ->addForeignKey($setup->getFkName($tableName, 'store_id', 'store', 'store_id'),
                'store_id', $setup->getTable('store'), 'store_id',
                Table::ACTION_CASCADE, Table::ACTION_CASCADE)

            ->addColumn('category_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => true])
            ->addIndex($setup->getIdxName($tableName, ['category_id']), ['category_id'])
            ->addForeignKey($setup->getFkName($tableName, 'category_id', 'catalog_category_entity', 'entity_id'),
                'category_id', $setup->getTable('catalog_category_entity'), 'entity_id',
                Table::ACTION_CASCADE, Table::ACTION_CASCADE)

            ->addColumn('cms_page_id', Table::TYPE_SMALLINT, null, ['unsigned' => false, 'nullable' => true])
            ->addIndex($setup->getIdxName($tableName, ['cms_page_id']), ['cms_page_id'])
            ->addForeignKey($setup->getFkName($tableName, 'cms_page_id', 'cms_page', 'page_id'),
                'cms_page_id', $setup->getTable('cms_page'), 'page_id',
                Table::ACTION_CASCADE, Table::ACTION_CASCADE)

            ->addColumn('option_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => true])
            ->addIndex($setup->getIdxName($tableName, ['option_id']), ['option_id'])
            ->addForeignKey($setup->getFkName($tableName, 'option_id', 'eav_attribute_option', 'option_id'),
                'option_id', $setup->getTable('eav_attribute_option'), 'option_id',
                Table::ACTION_CASCADE, Table::ACTION_CASCADE)

            ->addColumn('original_url_key', Table::TYPE_TEXT, 255, ['nullable' => false, 'default' => ''])

            ->addColumn('unique_key', Table::TYPE_TEXT, 255, ['nullable' => false])
            ->addIndex($setup->getIdxName($tableName, ['type', 'sub_type', 'store_id', 'unique_key', 'original_url_key']),
                ['type', 'sub_type', 'store_id', 'unique_key', 'original_url_key'], ['type' => 'unique'])

            ->addColumn('inferred_url_key', Table::TYPE_TEXT, 255, ['nullable' => false])

            ->addColumn('assigned_url_key', Table::TYPE_TEXT, 255, ['nullable' => true])

            ->addColumn('conflicting_url_key', Table::TYPE_TEXT, 255, ['nullable' => true])
            ->addIndex($setup->getIdxName($tableName, ['conflicting_url_key']), ['conflicting_url_key'])

            ->addColumn('conflict_resolution', Table::TYPE_TEXT, 20, ['nullable' => true])

            ->addColumn('route', Table::TYPE_TEXT, 80, ['nullable' => true])

            ->addColumn('param_name', Table::TYPE_TEXT, 80, ['nullable' => true])
            ->addColumn('requires_param_name', Table::TYPE_BOOLEAN, null, ['nullable' => true])
            ->addColumn('url_part', Table::TYPE_TEXT, 20, ['nullable' => true])

            ->addColumn('description', Table::TYPE_TEXT, 255, ['nullable' => true])

            ->addColumn('reference', Table::TYPE_TEXT, 255, ['nullable' => true])
            ->addIndex($setup->getIdxName($tableName, ['reference']), ['reference'])

        ;
        $db->createTable($table);


        $setup->endSetup();
    }
}