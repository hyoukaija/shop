<?php

namespace app\customer\controller;

use think\Controller;
use think\Request;
use app\backend\model\Category;
use app\backend\model\Item;
use app\shop\AddTool;

class CategoryController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $categories = Category::select();
        $this->assign('categories',$categories);
        return view('index');
    }

    /**
     * 显示所有商品
     *
     * @return \think\Response
     */
    public function itemList(Category $category)
    {
        $tool = AddTool::getIns();
        $calcType = $tool->calcType();
        $this->assign('calcType',$calcType);
        $items = Item::where('category_id',$category->id)->select();
        $this->assign('items',$items);
        return view('itemlist');
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
