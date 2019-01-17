<?php

namespace app\common\model;

use think\Model;
use app\facade\Auth;

class Buyer extends Model
{
    public function login($data)
    {
        $user = Buyer::get(['username'=>$data['username']]);
        return Auth::login($user,$data);
    }
}
