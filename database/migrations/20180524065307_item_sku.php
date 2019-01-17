<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ItemSku extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('item_sku', array('engine' => 'InnoDB'));
        $table->addColumn('item_id', 'integer', array('comment' => '商品id'))
            ->addColumn('attr_symbol_path', 'string', array('default' => '', 'comment' => '属性搭配方式'))
            ->addColumn('price', 'decimal', array('signed' => false, 'precision' => 10, 'scale' => 2, 'comment' => '价格'))
            ->addColumn('stock', 'integer', array('signed' => false, 'default' => 0, 'comment' => '在库'))
            ->addTimestamps()
            ->addSoftDelete()
            ->create();
    }
}
