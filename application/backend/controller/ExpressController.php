<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\common\model\Express;

class ExpressController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $expresses = Express::paginate(10);
        $this->assign('list',$expresses);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('index',compact('expresses'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = input('post.');

        $express = new Express();
        $express->express_type = $data['express_type'];
        $express->express_time = $data['express_time'];
        $express->weight = $data['weight'];
        $express->mongey = $data['mongey'];
        $express->status = $data['status'];

        if($express->save()){
            $this->success('保存成功','\backend\express\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
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
    public function edit(Express $express)
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('edit',compact('express'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Express $express)
    {
        $data = input('post.');

        $express->express_type = $data['express_type'];
        $express->express_time = $data['express_time'];
        $express->weight = $data['weight'];
        $express->mongey = $data['mongey'];
        $express->status = $data['status'];

        if($express->save()){
            $this->success('保存成功','\backend\express\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
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
