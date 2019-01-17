<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\common\model\User;
use app\facade\Auth;
use app\phpemail\GetOrder;
class LoginController extends Controller
{
    public function index()
    {
        // $mail = new GetOrder();
        // $mail->sendMail();
        return $this->fetch();
    }

    public function login()
    {
        $data = input('post.');
        $result = $this->validate($data,'app\common\validate\User.login');
        
        if($result !== true){
            $this->error($result);
        }
        $user = new User();
        if ($user->login($data)) {
            $this->success('登录成功');
        } else {
            $this->error('登录失败');
        }


    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
