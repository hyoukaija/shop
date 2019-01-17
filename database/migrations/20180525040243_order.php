<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Order extends Migrator
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
    // 0:新订单，1:确认库存，2:正在配送，3:配送完成，4:交易成功，5:交易未成功，6:退货中，7:取消，
    public function change()
    {
        $table = $this->table('order', array('engine' => 'InnoDB'));
        $table->addColumn('order_sn', 'string', array('limit' => 20, 'comment' => '订单编号'))
            ->addColumn('user_id', 'integer', array('signed'=>false, 'comment' => '用户id'))
            ->addColumn('order_status', 'integer', array('signed'=>false,'default' => '0', 'comment' => '订单状态，0-7'))
            ->addColumn('consignee', 'string', array('limit' => 60, 'default' => '未知', 'comment' => '收货人'))
            ->addColumn('country','string',array('limit'=>20,'default'=>'中国','comment' => '国家'))
            ->addColumn('province','string',array('limit'=>20,'comment' => '省份'))
            ->addColumn('city','string',array('limit'=>20,'comment' => '城市'))
            ->addColumn('district','string',array('limit'=>30,'comment' => '区'))
            ->addColumn('address','string',array('limit'=>90,'comment' => '地址'))
            ->addColumn('zipcode','string',array('limit'=>10,'comment' => '邮编'))
            ->addColumn('mobile','string',array('limit'=>20,'comment' => '手机'))
            ->addColumn('shipping_code','string',array('limit'=>32,'comment' => '物流code'))
            ->addColumn('shipping_name','string',array('limit'=>60,'comment' => '物流名称'))
            ->addColumn('items_price', 'decimal', array('signed' => false, 'precision' => 10, 'scale' => 2, 'comment' => '总价格'))
            ->addColumn('shipping_price', 'decimal', array('signed' => false, 'precision' => 10, 'scale' => 2, 'comment' => '邮费'))
            ->addColumn('total_amount', 'decimal', array('signed' => false, 'precision' => 10, 'scale' => 2, 'comment' => '订单总价'))
            ->addColumn('desc', 'string', array('limit' => 200,'comment' => '订单总价'))
            ->addColumn('confirm_time','datetime',array('comment' => '收货确认时间'))
            ->addColumn('is_checkout','integer',array('signed'=>false,'comment' => '0:未结算，1:以结算'))
            ->addTimestamps()
            ->addSoftDelete()
            ->addIndex('user_id',array('unique' => true))
            ->addIndex('order_sn',array('unique' => true))
            ->create();
    }
}
