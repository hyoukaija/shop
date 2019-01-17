<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ShoppingRecords extends Migrator
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
        $table = $this->table('shopping_records', array('engine' => 'InnoDB'));
        $table->addColumn('buyer_id', 'integer', array('signed'=>false, 'comment' => '采购员id'))
            ->addColumn('delivery_id', 'integer', array('signed'=>false, 'comment' => '发货员id'))
            ->addColumn('track_number','string',array('limit'=>15,'comment' => '快递编号'))
            ->addColumn('express_type','string',array('limit'=>15,'comment' => '快递种类'))
            ->addColumn('express_fee','integer',array('signed'=>false,'comment' => '快递费用'))
            ->addColumn('total_price','integer',array('signed'=>false,'limit'=>30,'comment' => '总费用'))
            ->addColumn('weight','integer',array('signed'=>false,'comment' => '重量'))
            ->addColumn('finish_day','datetime',array('default'=>null,'comment' => '完成时间'))
            ->addColumn('status','integer',array('default'=>1,'comment' => '状态，1:邮寄中，2:完成，3:退回，4:异常'))
            ->addColumn('taxed','boolean',array('default'=>false,'comment' => '被税'))
            ->addTimestamps()
            ->addSoftDelete()
            ->create();
    }
}
