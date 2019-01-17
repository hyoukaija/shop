<?php
namespace app\backend\controller;

use think\Controller;
use app\backend\model\AdminUser;
use think\Request;
use app\facade\Auth;
use think\facade\Session;

class LoginController extends Controller
{
    public function index()
    {
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
            $this->success('登录成功','/backend/index/index');
        } else {
            $this->error('登录失败');
        }
    }

    public function logout()
    {
        Auth::deleteSession();
        $this->success('退出成功','/backend/login');    
    }
}
