<?php

namespace app\deliver\model;

use think\Model;
use app\facade\Auth;

class DeliverUser extends Model
{
    public function login($data)
    {
        $user = DeliverUser::get(['username'=>$data['username']]);
        return Auth::login($user,$data);
    }
}
