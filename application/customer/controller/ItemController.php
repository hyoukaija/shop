<?php

namespace app\customer\controller;

use think\Controller;
use think\Request;
use app\backend\model\Item;
use app\shop\AddTool;

class ItemController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Item $item)
    {
        return view('index',compact('item'));
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function detail(Item $item)
    {
        $tool = AddTool::getIns();
        $calcType = $tool->calcType();
        $this->assign('calcType',$calcType);
        return view('detail',compact('item'));
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function ajax_detail()
    {
        $tool = AddTool::getIns();
        $calcType = $tool->calcType();
        return json_encode(['calcType'=>$calcType]);
        
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

    //添加购物车
    public function addshopcar(Request $request)
    {
        $data = input('post.');
        $tool = AddTool::getIns();
        // var_dump($data['id']);
        // exit();
        if(!$tool->add($data['id'],$data['title'],$data['sell_price'],(int)$data['number'])){
            return json_encode(['status' =>0,'msg' => '添加购物车失败，暂时不支持同种商品不同假钱下单']);
        }
        $item = Item::where('id',$data['id'])->find();
        // var_dump($item);
        // exit();
        return json_encode(['status' => 1,'msg' => 'success']);

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
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
