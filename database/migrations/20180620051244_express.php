<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Express extends Migrator
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
        $table = $this->table('express', array('engine' => 'InnoDB'));
        $table  ->addColumn('express_type', 'string', array('limit' => 15, 'default' => 'SAL', 'comment' => '邮寄种类'))
            ->addColumn('express_time', 'string', array('limit' => 16, 'default' => '', 'comment' => '大概时间'))
            ->addColumn('weight', 'integer', array('signed'=>false,'comment' => '重量'))
            ->addColumn('money', 'integer', array('signed'=>false, 'comment' => '假钱'))
            ->addColumn('status','integer',array('default'=>1,'comment' => '状态，0:未启用，1：启用'))
            ->addTimestamps()
            ->addSoftDelete()
            ->create();
    }
}
