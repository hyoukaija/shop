<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\common\model\User;

class UserController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $user = User::paginate(10);
        $this->assign('list',$user);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('index',compact('user'));
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

        $user = new user();
        $user->username = $data['username'];
        $user->nick = $data['nick'];
        $user->password = password_hash($data['password'],PASSWORD_BCRYPT);
        $user->email = $data['email'];
        $user->status = $data['status'];

        if($user->save()){
            $this->success('保存成功','\backend\user\index');
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
    public function edit(User $user)
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
    public function update(User $user)
    {
        $data = input('put.');

        $user->username = $data['username'];
        $user->nick = $data['nick'];
        $user->password = password_hash($data['password'],PASSWORD_BCRYPT);
        $user->email = $data['email'];
        $user->status = $data['status'];
        
        if($user->save()){
            $this->success('保存成功','\backend\user\index');
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
    public function delete(User $user)
    {
        if($user->delete()){
            $this->success('删除成功','\backend\user\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
    }
}
