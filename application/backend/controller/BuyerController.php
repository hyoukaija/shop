<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\common\model\Buyer;
use app\facade\Auth;

class BuyerController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $buyer = Buyer::paginate(10);
        $this->assign('list',$buyer);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('index',compact('buyer'));
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

        $buyer = new Buyer();
        $buyer->username = $data['username'];
        $buyer->nick = $data['nick'];
        $buyer->password = password_hash($data['password'],PASSWORD_BCRYPT);
        $buyer->email = $data['email'];
        $buyer->status = $data['status'];

        if($buyer->save()){
            $this->success('保存成功','\backend\buyer\index');
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
    public function edit(Buyer $user)
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
    public function update(Buyer $buyer)
    {
        $data = input('put.');

        $buyer->username = $data['username'];
        $buyer->nick = $data['nick'];
        $buyer->password = password_hash($data['password'],PASSWORD_BCRYPT);
        $buyer->email = $data['email'];
        $buyer->status = $data['status'];
        
        if($buyer->save()){
            $this->success('保存成功','\backend\buyer\index');
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
    public function delete(Buyer $buyer)
    {
        if($buyer->delete()){
            $this->success('删除成功','\backend\buyer\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
    }
}
