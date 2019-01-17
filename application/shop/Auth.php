<?php
namespace app\shop;

use think\facade\Session;

/**
* 
*/
class Auth
{
    public $config;

    public function __construct()
    {
        $this->config = config('auth');
    }

    public function login($user,$data)
    {
        if($this->isValid($user,$data) === false){
            return false;
        }
        $expire = time() + 3600;
        if(!empty($data['is_remember'])) {
            $expire = time() + 3600 * 24;
        }
        $userInfo = [
            'id' => $user->id,
            'username' => $user->username,
            'time' => time()
        ];

        $sessionPrefix = $this->config['session_prefix'];
        Session::set($sessionPrefix.'user_info',$userInfo);
        Session::set($sessionPrefix.'expire',$expire);
        Session::set($sessionPrefix.'auth_sign',$this->authSign($userInfo));
        return true;
    } 

    public function isValid($user,$data)
    {
        if(empty($user) || empty($data)){
            return false;
        }

        return password_verify($data['password'],$user->password);
    }

    public function authSign($userInfo)
    {
        $appSecret = $this->config['app_secret'];
        $code = http_build_query($userInfo);
        return strtoupper(sha1($appSecret.$code));
    }

    public function getSession($path)
    {
        $sessionPrefix = $this->config['session_prefix'];
        return session($sessionPrefix.$path);
    }

    public function isLogin()
    {
        if(empty($this->getSession('user_info'))){
            return false;
        } elseif ($this->getSession('expire') < time()) {
            $this->deleteSession();
            return false;
        } elseif ($this->getSession('auth_sign') != $this->authSign($this->getSession('user_info'))){
            return false;
        } else {
            return true;
        }
    }

    public function deleteSession()
    {
        $sessionPrefix = $this->config['session_prefix'];
        Session::delete($sessionPrefix.'user_info');
        Session::delete($sessionPrefix.'expire');
        Session::delete($sessionPrefix.'auth_sign');
        return true;
    }













}