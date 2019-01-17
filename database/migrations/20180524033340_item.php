<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Item extends Migrator
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
        $table = $this->table('item', array('engine' => 'InnoDB'));
        $table->addColumn('titel', 'string', array('limit' => 30, 'default' => '', 'comment' => '商品名称'))
            ->addColumn('pic_url', 'string', array('limit' => 255, 'default' => '', 'comment' => '图片'))
            ->addColumn('samll_imgaes', 'string', array('limit' => 255, 'default' => '', 'comment' => '辅图'))
            ->addColumn('desc', 'string', array('limit' => 32, 'default' => '', 'comment' => '商品描述'))
            ->addColumn('category_id','integer',array('comment' => '分类id' ))
            ->addTimestamps()
            ->addSoftDelete()
            ->addIndex('category_id',array('unique' => true))
            ->create();
    }
}
