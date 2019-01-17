<?php

namespace app\backend\controller;

use think\Request;
use app\common\model\ShoppingRecords;
use app\facade\Auth;
use app\common\model\Buyer;
use app\common\model\Dilivery;
use app\backend\model\Item;
use app\common\model\Instock;
use app\backend\model\ItemAttrVal;
use app\backend\model\ItemAttrKey;

class ShoppingRecordsController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $shopping_records = ShoppingRecords::paginate(10);
        foreach ($shopping_records as $key => $value) {
            $buyer = Buyer::where('id',$value->buyer_id)->find();
            $dilivery = dilivery::where('id',$value->dilivery_id)->find();
            if (isset($buyer)) {
                $value->buyer_id = $buyer->nick;
            }else {
                $this->error('获取采购员错误！');
            }
            if (isset($dilivery)) {
                $value->dilivery_id = $dilivery->nick;
            } else {
                $this->error('获取发货员错误！');
            }
        }
        $this->assign('list',$shopping_records);
        return view('index',compact('shopping_records'));
    }

    /**
     * 显示库存.
     *
     * @return \think\Response
     */
    public function stock()
    {
        $instock = Instock::where('out_price',0)->select();
        // $val = ItemAttrVal::alias('val')->join(['our_item_attr_key'=>'key'],['key.item_id = val.item_id','val.attr_key_id = key.id'])->select();
        foreach($instock as $value) {
            $arr = explode(';',$value['attr_symbol_path']);
            $value[]

        }
        foreach ($val as $v) {
            var_dump($v);
            echo '<br >';
        }
        print('aa');
        
        exit();
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('create');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $buyers = Buyer::column('nick','id');
        $diliveries = Dilivery::column('nick','id');
        $this->assign('buyers',$buyers);
        $this->assign('diliveries',$diliveries);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = input('post.');
        
        // $validate = new \app\backend\validate\Category;

        // if(!$validate->check($data)){
        //     $this->error($validate->getError());
        // }

        $record = new ShoppingRecords();
        $record->buyer_id = $data['buyer_id'];
        $record->dilivery_id = $data['dilivery_id'];
        $record->express_number = $data['express_number'];
        $record->express_type = $data['express_type'];
        $record->express_fee = $data['express_fee'];
        $record->total_price = $data['total_price'];
        $record->weight = $data['weight'];
        $record->status = $data['status'];
        $record->taxed = $data['taxed'];

        // var_dump($record);
        // exit();

        $file = request()->file('image');
        $info = $file->move('../public/static/backend/express','');
        if($info) {
            $record->pic_url = $info->getFileName();    
        } else {
            echo $file->getError();
        }
        if($record->save()){
            $this->success('保存成功','\backend\shopping_records\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
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
     * 记录发货信息
     *
     * @return \think\Response
     */
    public function records($express_id = '')
    {
        $this->assign('express_id',$express_id);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('records');
    }

    /**
     * 保存发货信息
     *
     * @return \think\Response
     */
    public function save_records()
    {
        $data = input('post.');
        $record = new Instock();
        $list = [];
        for ($i=0; $i < count($data['item_id']); $i++) {
            for ($j=0; $j < $data['number'][$i]; $j++) { 
                $item['express_id'] = $data['express_id'];
                $item['item_id'] = $data['item_id'][$i];
                $item['attr_symbol_path'] = $data['attr_symbol_path'][$i];
                $item['in_price'] = $data['inprice'][$i];

                array_push($list, $item);   
            }      
        }
        if($record->saveAll($list)){
            $this->success('保存成功','\backend\shopping_records\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
        
    }

    /**
     * 返回产品搜索结果
     *
     * @return \think\Response
     */
    public function search_items()
    {
        $key = input('get.')['key'];

        $items = Item::where('keywords','like','%'.$key.'%')->select();
        return json_encode($items);
    }

    /**
     * 返回产品商品属性结果
     *
     * @return \think\Response
     */
    public function search_items_attr()
    {
        $key = input('get.')['key'];

        $attr_value = ItemAttrVal::where('item_id',$key)->column('symbol','attr_value');  
        
        return json_encode($attr_value,JSON_UNESCAPED_UNICODE);
    }



    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(ShoppingRecords $record)
    {
        $buyers = Buyer::column('nick','id');
        $diliveries = Dilivery::column('nick','id');
        $this->assign('buyers',$buyers);
        $this->assign('diliveries',$diliveries);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('edit',compact('record'));
    }

    /**
     * 显示购物详情，对应每次邮寄.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function details($id)
    {   
        $records = Instock::where('express_id',$id)->select();
        $express = ShoppingRecords::where('id',$id)->find();
        $express_number = $express->express_number;
        foreach ($records as $key => $value) {
            $item = Item::where('id',$value->item_id)->find();
            $value->item_id = $item->title;
            $value->time = $express->create_time;
        }
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $this->assign('express_number',$express_number);
        return view('details',compact('records'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(ShoppingRecords $record)
    {
        $data = input('put.');
        

        $record->buyer_id = $data['buyer_id'];
        $record->dilivery_id = $data['dilivery_id'];
        $record->express_number = $data['express_number'];
        $record->express_type = $data['express_type'];
        $record->express_fee = $data['express_fee'];
        $record->total_price = $data['total_price'];
        $record->weight = $data['weight'];
        $record->status = $data['status'];
        $record->taxed = $data['taxed'];


        $file = request()->file('image');
        if($file){
            $info = $file->move('../public/static/backend/express','');
            if($info) {
                $record->pic_url = $info->getFileName();    
            } else {
                echo $file->getError();
            }
        }
        
        if($record->save()){
            $this->success('保存成功','\backend\shopping_records\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
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
