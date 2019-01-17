<?php

namespace app\backend\validate;
use think\Validate;

class Item extends validate
{
    protected $rule = [
        'title' => 'require|length:2,16|token',
    ];

    protected $field = [
        'title' => '商品名'
        ];

    protected $scene = [
    ];
}