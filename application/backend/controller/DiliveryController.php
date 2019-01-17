<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\common\model\Dilivery;
use app\facade\Auth;

class DiliveryController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $dilivery = Dilivery::paginate(10);
        $this->assign('list',$dilivery);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('index',compact('dilivery'));
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
        
        // $validate = new \app\backend\validate\Category;

        // if(!$validate->check($data)){
        //     $this->error($validate->getError());
        // }

        $dilivery = new Dilivery();
        $dilivery->username = $data['username'];
        $dilivery->nick = $data['nick'];
        $dilivery->password = password_hash($data['password'],PASSWORD_BCRYPT);
        $dilivery->email = $data['email'];
        $dilivery->status = $data['status'];

        if($dilivery->save()){
            $this->success('保存成功','\backend\dilivery\index');
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
    public function edit(Dilivery $user)
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('edit',compact('user'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Dilivery $dilivery)
    {
        $data = input('put.');

        $dilivery->username = $data['username'];
        $dilivery->nick = $data['nick'];
        $dilivery->password = password_hash($data['password'],PASSWORD_BCRYPT);
        $dilivery->email = $data['email'];
        $dilivery->status = $data['status'];
        
        if($dilivery->save()){
            $this->success('保存成功','\backend\dilivery\index');
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
    public function delete(Dilivery $dilivery)
    {
        if($dilivery->delete()){
            $this->success('删除成功','\backend\dilivery\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
    }
}
