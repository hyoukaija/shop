<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ItemAttrVal extends Migrator
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
        $table = $this->table('item_attr_val', array('engine' => 'InnoDB'));
        $table->addColumn('attr_key_id','integer',array('signed' => false,'comment'=>'属性id'))
              ->addColumn('item_id','integer',array('signed' => false, 'comment' => '商品id'))
              ->addColumn('symbol','integer',array('signed' => false, 'comment' => '属性编码'))
              ->addColumn('attr_value','string',array('signed' => false, 'comment' => '属性值'))
              ->addTimestamps()
              ->addSoftDelete()
              ->addIndex('item_id',array('unique' => true))
              ->addIndex('attr_key_id',array('unique' => true))
              ->create();
    }
}



