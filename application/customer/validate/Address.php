<?php

namespace app\customer\validate;
use think\Validate;

class Address extends validate
{
    protected $rule = [
        'consignee' => 'require|length:2,16|token',
        'mobile' => 'number|length:11',
    ];

    protected $field = [
        'consignee' => '用户名',
        'mobile' => '手机号',
        ];

    protected $scene = [
    ];
}