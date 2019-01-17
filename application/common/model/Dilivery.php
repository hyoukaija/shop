<?php

namespace app\common\model;

use think\Model;
use app\facade\Auth;

class Dilivery extends Model
{
    public function login($data)
    {
        $user = Dilivery::get(['username'=>$data['username']]);
        return Auth::login($user,$data);
    }
}
