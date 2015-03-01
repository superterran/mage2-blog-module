<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/* @var $installer \Magento\Setup\Module\SetupModule */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'cms_block'
 */
$table = $installer->getConnection()->newTable(
    $installer->getTable('superterran_blog_posts')
)->addColumn(
    'post_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['identity' => true, 'nullable' => false, 'primary' => true],
    'Post ID'
)->addColumn(
    'title',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => false],
    'Post Title'
)->addColumn(
    'identifier',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => false],
    'Post Slug'
)->addColumn(
    'content',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    '2M',
    [],
    'Post Content'
)->addColumn(
    'creation_time',
    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
    null,
    [],
    'Creation Time'
)->addColumn(
    'update_time',
    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
    null,
    [],
    'Modification Time'
)->addColumn(
    'is_active',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['nullable' => false, 'default' => '1'],
    'Is Post Active'
)->setComment(
    'Blog Post Table'
);
$installer->getConnection()->createTable($table);

/**
 * Create table 'cms_block_store'
 */
$table = $installer->getConnection()->newTable(
    $installer->getTable('blog_post_store')
)->addColumn(
    'post_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['nullable' => false, 'primary' => true],
    'Post ID'
)->addColumn(
    'store_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['unsigned' => true, 'nullable' => false, 'primary' => true],
    'Store ID'
)->addIndex(
    $installer->getIdxName('blog_post_store', ['store_id']),
    ['store_id']
)->addForeignKey(
    $installer->getFkName('blog_post_store', 'post_id', 'blog_post', 'post_id'),
    'post_id',
    $installer->getTable('blog_post'),
    'post_id',
    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
)->addForeignKey(
    $installer->getFkName('blog_post_store', 'store_id', 'store', 'store_id'),
    'store_id',
    $installer->getTable('store'),
    'store_id',
    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
)->setComment(
    'CMS Post To Store Linkage Table'
);
$installer->getConnection()->createTable($table);

$installer->endSetup();