<?php

namespace app\common\validate;
use think\Validate;

class User extends validate
{
    protected $rule = [
        'username' => 'require|length:2,16|token',
        'email' => 'require|email',
        'password' => 'require|length:6,15',
        'password_confirm' => 'require|length:6,15|confirm:password',
        'captcha|captcha' => 'require|captcha'
    ];

    protected $field = [
        'username' => '用户名',
        'email' => '邮箱',
        'password' => '密码',
        'password_confirm' => '再次密码',
        'captcha' => '验证码'
        ];

    protected $scene = [
        'login'=>['username','password','captcha']
    ];
}