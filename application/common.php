<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function select($data=array(), $name = "",$value = "", $class = "")
{
    $re = '<select class="'.$class.'" name="'.$name.'" id="'.$name.'">';
    foreach($data as $key => $row) {
        $selected = "";
        if($key == $value){
            $selected = "selected";
        }
        $re.='<option value="'.$key.'" '.$selected.'>'.$row.'</option>';
    }
    $re .= '</select>';

    return $re;
}