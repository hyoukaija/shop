<?php

namespace app\backend\model;

use think\Model;

class ItemAttrKey extends Model
{
    public function vals()
    {
        return $this->hasMany('ItemAttrVal','attr_key_id');
    }
}
