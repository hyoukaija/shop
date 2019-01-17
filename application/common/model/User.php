<?php

namespace app\common\model;

use think\Model;
use app\facade\Auth;

class User extends Model
{
    public function login($data)
    {
        $user = User::get(['username'=>$data['username']]);
        return Auth::login($user,$data);
    }
}
