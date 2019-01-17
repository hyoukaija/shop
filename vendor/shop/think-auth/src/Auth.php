<?php
namespace think\auth;


class Auth
{
    public $config;

    public function __construct()
    {
        $this->config = config('auth');
    }

    public function login($user,$data)
    {
        
    }
    
}