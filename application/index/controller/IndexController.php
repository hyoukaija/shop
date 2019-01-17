<?php
namespace app\index\controller;


class IndexController
{
    public function index()
    {
        return view('index');
    }

}

/*
object(stdClass)#112 (4) { 
    ["format_list"]=> array(2) { 
        [0]=> object(stdClass)#113 (3) { 
            ["id"]=> string(1) "1" 
            ["name"]=> string(12) "机身颜色" 
            ["format_val_list"]=> array(3) { 
                [0]=> object(stdClass)#114 (2) { 
                    ["id"]=> string(3) "110" 
                    ["name"]=> string(6) "银色" } 
                [1]=> object(stdClass)#115 (2) { 
                    ["id"]=> string(3) "111" 
                    ["name"]=> string(6) "黑色" }
                [2]=> object(stdClass)#116 (2) { 
                    ["id"]=> string(3) "112" 
                    ["name"]=> string(6) "金色" } 
                } 
            } 
        [1]=> object(stdClass)#117 (3) { 
            ["id"]=> string(1) "3" 
            ["name"]=> string(12) "机身内存" 
            ["format_val_list"]=> array(3) { 
                [0]=> object(stdClass)#118 (2) { 
                    ["id"]=> string(3) "310" 
                    ["name"]=> string(4) "16GB" } 
                [1]=> object(stdClass)#119 (2) { 
                    ["id"]=> string(3) "311" 
                    ["name"]=> string(4) "32GB" } 
                [2]=> object(stdClass)#120 (2) { 
                    ["id"]=> string(3) "312" 
                    ["name"]=> string(4) "64GB" } 
                }
            }
        }
    ["sku_sale_list"]=> object(stdClass)#121 (4) { 
        ["110;310"]=> object(stdClass)#122 (2) { 
            ["price"]=> float(3500) 
            ["count"]=> int(11) } 
        ["110;311"]=> object(stdClass)#123 (2) { 
            ["price"]=> float(3501) 
            ["count"]=> int(5) } 
        ["111;312"]=> object(stdClass)#124 (2) { 
            ["price"]=> float(3502) 
            ["count"]=> int(99) } 
        ["112;311"]=> object(stdClass)#125 (2) { 
            ["price"]=> float(3503) 
            ["count"]=> int(10) } 
    } 
    ["error_code"]=> string(4) "0000" 
    ["error_msg"]=> string(2) "OK" 
}
*/
