<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\common\model\User;
class RegisterController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->fetch();
    }

    public function save()
    {
        $data = input('post.');
        
        $validate = new \app\common\validate\User;

        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $user = new User();
        $user->username = $data['username'];
        $user->password = password_hash($data['password'],PASSWORD_BCRYPT);
        
        $user->email = $data['email'];
        if($user->save()){
            $this->success('注册成功','\login');
        } else {
            $this->error('注册失败，请联系f8fengh@163.com');
        }
    }
}
