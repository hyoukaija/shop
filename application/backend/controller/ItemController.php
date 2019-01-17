<?php

namespace app\backend\controller;

use think\Request;
use app\backend\model\Item;
use app\backend\model\ItemAttrKey;
use app\backend\model\ItemAttrVal;
use app\backend\model\ItemSku;
use app\backend\model\Category;
use app\facade\Auth;
use think\Image;

class ItemController extends CommonController
{
    public function index()
    {
        
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $items = Item::paginate(10);
        foreach ($items as $key => $value) {
            $sku = ItemSku::where('item_id',$value['id'])->column('attr_symbol_path,price,stock','attr_symbol_path'); 
            
            foreach ($sku as $key_sku => $value_sku) {
                $inventory = explode(",",$value_sku['attr_symbol_path']);
                $item_attr_key = ItemAttrKey::where('item_id',$value['id'])->column('id','attr_name'); 
                foreach ($item_attr_key as $key_attr => $value_attr) {
                    $item_attr_key[$key_attr] = ItemAttrVal::where('item_id',$value['id'])->where('attr_key_id',$value_attr)->where('symbol',array_shift($inventory))->value('attr_value'); 
                }
                $sku[$key_sku]['attr_symbol_path'] = $item_attr_key; 

            }
            $value['sku'] = $sku;
            
        }
        // var_dump($items);
        // exit();
        $this->assign('list',$items);
        return view('index',compact('items'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $categories = Category::column('name','id');
        return view('create',compact('categories'));
    }

    /**
     * 保存图片辅助函数
     *
     */
    public function save_picture(Item $item,$t = "",$f = "",$tar = "")
    {
        $file = request()->file($f);
        $image = Image::open($file);
        $info = $file->move('../public/static/customer/items/'.$t,'');
        if($info) {
            $item->$tar = $info->getFilename();
            $image->thumb(150,150)->save('../public/static/customer/items/'.$t.'/thumb_'.$info->getFilename());
            if($f == 'image_1'){
                $item->thumb_image = $info->getFilename();
            }
        } else {
            echo $file->getError();
        }
        return $item;
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
        
        // $validate = new \app\backend\validate\Item;

        // if(!$validate->check($data)){
        //     $this->error($validate->getError());
        // }

        $item = new Item();

        for ($i=1; $i < 5; $i++) { 
            $item = $this->save_picture($item,$data['title'],'image_'.$i,'pic_url_0'.$i);
        }

        $item->title = $data['title'];
        $item->category_id = $data['category_id'];
        $item->desc = $data['desc'];
        $item->details = $data['details'];
        $item->made_in = $data['made_in'];
        $item->weight = $data['weight'];
        $item->source_of_goods = $data['source_of_goods'];
        $item->price = $data['price'];
        $item->no_profit_price = $data['no_profit_price'];
        $item->release_time = $data['release_time'];
        $item->keywords = $data['keywords'];
        $item->status = $data['status'];
        if($item->save()){
            $this->success('保存成功','\backend\item\index');
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
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Item $item)
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        $categories = Category::column('name','id');
        return view('edit',compact('item','categories'));
    }

    /**
     * 保存更新的资源
     *
     * @return \think\Response
     */
    public function update(Item $item)
    {
        $data = input('put.');
        
        
            for ($i=1; $i < 5; $i++) {
                if(request()->file('image_'.$i)){
                    $item = $this->save_picture($item,$data['title'],'image_'.$i,'pic_url_0'.$i);
                }
            }
        
        
        

        // $item->title = $data['title'];
        $item->category_id = $data['category_id'];
        $item->desc = $data['desc'];
        $item->details = $data['details'];
        $item->made_in = $data['made_in'];
        $item->weight = $data['weight'];
        $item->capacity = $data['capacity'];
        $item->source_of_goods = $data['source_of_goods'];
        $item->price = $data['price'];
        $item->no_profit_price = $data['no_profit_price'];
        $item->release_time = $data['release_time'];
        $item->keywords = $data['keywords'];
        $item->status = $data['status'];
        if($item->save()){
            $this->success('保存成功','\backend\item\index');
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
    public function delete(Item $item)
    {
        if($item->delete()){
            $this->redirect('\backend\item\index');
        } else {
            $this->error('删除失败');
        }

    }
}



