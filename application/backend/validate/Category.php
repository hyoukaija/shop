<?php

namespace app\backend\validate;
use think\Validate;

class Category extends validate
{
    protected $rule = [
        'name' => 'require|length:2,16|token',
    ];

    protected $field = [
        'name' => '列表分类'
        ];

    protected $scene = [
    ];
}