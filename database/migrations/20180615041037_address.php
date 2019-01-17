<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Address extends Migrator
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
        $table = $this->table('address', array('engine' => 'InnoDB'));
        $table->addColumn('user_id', 'integer', array('signed'=>false, 'comment' => '用户id'))
            ->addColumn('consignee', 'string', array('limit' => 60, 'default' => '未知', 'comment' => '收货人'))
            ->addColumn('country','string',array('limit'=>20,'default'=>'中国','comment' => '国家'))
            ->addColumn('province','string',array('limit'=>20,'comment' => '省份'))
            ->addColumn('city','string',array('limit'=>20,'comment' => '城市'))
            ->addColumn('district','string',array('limit'=>30,'comment' => '区'))
            ->addColumn('address','string',array('limit'=>90,'comment' => '地址'))
            ->addColumn('zipcode','string',array('limit'=>10,'comment' => '邮编'))
            ->addColumn('mobile','string',array('limit'=>20,'comment' => '手机'))
            ->addTimestamps()
            ->addSoftDelete()
            ->create();
    }
}
