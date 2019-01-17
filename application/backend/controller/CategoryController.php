<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\backend\model\Category;
use app\facade\Auth;

class CategoryController extends CommonController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        $this->assign('list',$categories);
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('index',compact('categories'));
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
        
        $validate = new \app\backend\validate\Category;

        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $category = new Category();
        $category->name = $data['name'];

        $file = request()->file('image');
        $info = $file->move('../public/static/customer/category','');
        if($info) {
            $category->image = $info->getFileName();    
        } else {
            echo $file->getError();
        }
        if($category->save()){
            $this->success('保存成功','\backend\category\index');
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
    public function edit(Category $category)
    {
        $session = Auth::getSession('user_info');
        $this->assign('session',$session);
        return view('edit',compact('category'));
    }

    /**
     * 保存更新的资源
     *
     * @return \think\Response
     */
    public function update(Category $category)
    {
        $data = input('put.');
        
        $validate = new \app\backend\validate\Category;

        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $category->name = $data['name'];
        
        $file = request()->file('image');
        $info = $file->move('../public/static/customer/category','');
        if($info) {
            $category->image = $info->getFileName();    
        } else {
            echo $file->getError();
        }
        if($category->save()){
            $this->success('保存成功','\backend\category\index');
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
    public function delete(Category $category)
    {   
        if($category->delete()){
            $this->success('删除成功','\backend\category\index');
        } else {
            $this->error('保存失败，请联系f8fengh@163.com');
        }
    }
}
