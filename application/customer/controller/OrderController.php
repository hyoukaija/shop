<?php

namespace app\customer\controller;

use think\Controller;
use think\Request;
use app\backend\model\Item;
use app\common\model\Address;
use app\facade\Auth;

class OrderController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function submit_order()
    {
        return view('submit_order');
    }

    /**
     * 确认订单
     *
     * @return \think\Response
     */
    public function confirm()
    {
        $data = input('post.');
        $session = Auth::getSession('user_info');
        $address = Address::where('id',$session)
        $item = Item::where('id',$data['id'])->find();
        $item->sell_price = $data['sell_price'];
        $item->number = $data['number'];
        $this->assign('item',$item);
        return view('confirm');
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
