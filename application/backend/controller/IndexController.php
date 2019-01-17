<?php
namespace app\backend\controller;

use think\Controller;
use app\facade\Auth;

class IndexController extends CommonController
{
    public function index()
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('index');
    }

    public function login()
    {
        $data = input('post.');
        $result = $this->validate($data,'app\common\validate\User.login');
        
        if($result !== true){
            $this->error($result);
        }
        $user = new AdminUser();
        if ($user->login($data)) {
            $this->success('登录成功');
        } else {
            $this->error('登录失败');
        }
    }
}
