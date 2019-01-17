<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\facade\Auth;
use app\backend\model\Item;
use app\backend\model\ItemAttrKey;
use app\backend\model\ItemAttrVal;
use app\common\model\Instock;
class SkuController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($id)
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $res = [];
        $res_index = []; //记录属性值
        $res_first = [];//记录第一个
        $key = ItemAttrKey::where('item_id',$id)->select();
        $val = ItemAttrVal::where('item_id',$id)->select();
        $instock = Instock::where('item_id',$id)->select();
        foreach ($key as $k_key => $v_key) {
            array_push($res_index,$v_key['attr_name']);
            if(!isset($key_mark)){
                $key_mark = $v_key['id'];
                foreach ($val as $k_val => $v_val) {
                    if ($v_key['id'] == $v_val['attr_key_id']) {
                        $res_first[$v_val['attr_value']] = $v_val['symbol'];
                        $res[$v_val['attr_value']] = [];
                    }
                }
            } else {
                foreach ($val as $k_val => $v_val) {
                    if (!array_key_exists($v_val['attr_value'], $res)) {
                        foreach ($res as $k_res => $v_res) {
                            $res[$k_res][$v_val['symbol']] = [$v_val['attr_value']];
                        }
                    }
                }
            }
        }

        foreach ($res as $k_res => $v_res) {
            if (empty($v_res)) {
                $num = 0;
                foreach ($instock as $k_instock => $v_instock) {
                    if ($res_first[$k_res] == $v_instock['attr_symbol_path']) {
                        $num += 1;
                    }
                }
                array_push($res[$k_res],$num);
            } else {
                foreach ($v_res as $k_second => $v_second) {
                    $num = 0;
                    foreach ($instock as $k_instock => $v_instock) {
                        if ($res_first[$k_res].';'.$k_second == $v_instock['attr_symbol_path']) {
                            $num += 1;
                        }
                    }
                    array_push($res[$k_res][$k_second],$num);
                }
                
            }
        }
        // var_dump($res);
        // exit();
        $this->assign('id',$id);
        $this->assign('res_index',$res_index);
        return view('index',compact('res'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }


    /**
     * 添加sku属性.
     *
     * @return \think\Response
     */
    public function add_attr($id)
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $this->assign('attr_val',ItemAttrVal::where('item_id',$id)->select());
        $this->assign('id',$id);
        return view('add_attr');
    }

    /**
     * 保存sku属性.
     *
     * @return \think\Response
     */
    public function save_attr()
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        
        $data = input('post.');
        $attr_key = new ItemAttrKey();
        $attr_val = new ItemAttrVal();
        $list_key = [];
        $list_val = [];
        $data_attr_name = array_unique($data['attr_name']);

        for ($i=0; $i < count($data_attr_name); $i++) { 
                $key['item_id'] = $data['item_id'];
                $key['attr_name'] = $data_attr_name[$i];
                array_push($list_key, $key);
        }
        $attr_key_id = $attr_key->saveAll($list_key);
        foreach ($attr_key_id as $key => $value) {
            foreach ($data['attr_name'] as $k_data => $v_data) {
                if ($value['attr_name'] == $v_data) {
                    $v_data = $value['id'];
                }
                $data['attr_name'][$k_data] = $v_data;
            }
        }
        $key = [];
        for ($i=0; $i < count($data['attr_value']); $i++) { 
                $key['item_id'] = $data['item_id'];
                $key['attr_value'] = $data['attr_value'][$i];
                $key['attr_key_id'] = $data['attr_name'][$i];
                $key['symbol'] = $i;
                array_push($list_val, $key);
        }
        if($attr_val->saveAll($list_val)){
            $this->success('保存成功','\backend\item\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }

        return view('add_attr');
    }


    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
