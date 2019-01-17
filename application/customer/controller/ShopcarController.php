<?php

namespace app\customer\controller;

use think\Controller;
use think\Request;
use app\backend\model\Item;
use app\shop\AddTool;
class ShopcarController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $shopcar = session('shopcar');
        // var_dump($shopcar);
        // exit();
        // $this->assign('items',$items);
        if(!empty($shopcar)){
            $items = Item::all(array_keys($shopcar));
            foreach ($items as $key => $value) {
                $value->sell_price = $shopcar[$value->id]['sell_price'];
                $value->number = $shopcar[$value->id]['number'];
            }
            $total_money = AddTool::getIns()->calcMoney();
            $this->assign('total_money',$total_money);
            $this->assign('items',$items);
        }
        
        return view('index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除所有资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        $tool = AddTool::getIns();
        $tool->clear();
        return json_encode(['msg' => 1]);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function one_delete($id)
    {
        $tool = AddTool::getIns();
        $tool->del($id);
        return json_encode(['msg'=>'success']);
    }

    /**
     * 增加一个商品数量
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function add_one($id)
    {
        $msg = 'failure';
        $status = 0;
        $tool = AddTool::getIns();
        if($tool->addOne($id)){
            $status = 1;
            $msg = 'success';
        }
        return json_encode(['msg'=>$msg,'status' =>$status]);

    }
    
    /**
     * 减少一个商品数量
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function reduce_one($id)
    {
        $msg = 'failure';
        $status = 0;
        $tool = AddTool::getIns();
        if($tool->decr($id)){
            $status = 1;
            $msg = 'success';
        }
        return json_encode(['msg'=>$msg,'status' =>$status]);

    }   
}
