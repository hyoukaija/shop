<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ItemAttrKey extends Migrator
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
        $table = $this->table('item_attr_key', array('engine' => 'InnoDB'));
        $table->addColumn('item_id','integer',array('signed' => false, 'comment' => '商品id'))
              ->addColumn('attr_name','string',array('limit' => 50, 'comment' => '属性名称'))
              ->addTimestamps()
              ->addSoftDelete()
              ->addIndex('item_id',array('unique' => true))
              ->create();
    }
}


