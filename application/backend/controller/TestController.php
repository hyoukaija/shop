<?php

namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\backend\model\Category;

class TestController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // $db = Db('data');
        // // $db->insert(['name'=>'fengyang','age'=>'28','sex'=>1]);
        // $db->where('id',4)->update(['name'=>'jiang']);
        // $category = Category::select();
        // $this->assign('category',$category);

        return $this->fetch('test');
    }

    public function my_try()
    {
        $data['name'] = "fenghai";
        echo json_encode($data);
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
