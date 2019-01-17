<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Address extends Model
{
    use SoftDelete;
}
