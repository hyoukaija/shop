<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Instock extends Migrator
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
        $table = $this->table('instock', array('engine' => 'InnoDB'));
        $table  ->addColumn('express_id', 'integer', array('signed'=>false, 'comment' => '邮寄id'))
            ->addColumn('item_id', 'integer', array('signed'=>false, 'comment' => '商品id'))
            ->addColumn('attr_symbol_path', 'integer', array('signed'=>false, 'comment' => '型号'))
            ->addColumn('in_price', 'integer', array('signed'=>false,'comment' => '买入价'))
            ->addColumn('out_price', 'integer', array('signed'=>false,'default'=>0,'comment' => '卖出价'))
            ->addTimestamps()
            ->create();
    }
}
