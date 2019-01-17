<?php

namespace app\backend\model;

use think\Model;
use app\facade\Auth;

class AdminUser extends Model
{
    public function login($data)
    {
        $user = AdminUser::get(['username'=>$data['username']]);
        return Auth::login($user,$data);
    }
}
