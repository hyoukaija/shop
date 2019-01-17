<?php
namespace app\facade;

use think\Facade;

class Auth extends Facade
{
    public static function getFacadeClass()
    {
        return 'app\shop\Auth';
    }


}