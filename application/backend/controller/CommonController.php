<?php
namespace app\backend\controller;

use think\Controller;
use app\facade\Auth;
use think\Request;

class CommonController extends Controller
{
    
    protected function initialize()
    {
        if(!Auth::isLogin()) {
            $this->redirect('/backend/login');
        }
    }

    public function upload(){
        $file = Request::file('file');
        $info = $file->move('upload');
    }
}