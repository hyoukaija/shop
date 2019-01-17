<?php

namespace app\backend\model;

use think\Model;
use think\model\concern\SoftDelete;
class Item extends Model
{
    use SoftDelete;
}
