<?php

namespace app\customer\controller;

use think\Controller;
use think\Request;
use app\common\model\Address;
use app\facade\Auth;

class AddressController extends CommonController
{
    /**
     * 显示地址列表
     *
     * @return \think\Response
     */
    public function index()
    {

    }

    /**
     * 显示地址列表
     *
     * @return \think\Response
     */
    public function address_list()
    {
        $session = Auth::getSession('user_info');
        $address = Address::where('user_id',$session['id'])->select();
        $this->assign('address',$address);
        return view('address_list');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
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
        $session = Auth::getSession('user_info');
        $data = input('post.');
        
        $validate = new \app\customer\validate\Address;

        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $address = new Address();

        $address->consignee = $data['consignee'];
        $address->is_default = $data['is_default'];
        $address->user_id = $session['id'];
        $address->country = '中国';
        $address->province = $data['province'];
        $address->city = $data['city'];
        $address->district = $data['district'];
        $address->address = $data['address'];
        $address->zipcode = $data['zipcode'];
        $address->mobile = $data['mobile'];

        if($address->save()){
            $this->success('保存成功','\customer\address\address_list');
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
    public function edit(Address $address)
    {
        return view('edit',compact('address'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Address $address)
    {
        $session = Auth::getSession('user_info');
        $data = input('put.');
        
        $validate = new \app\customer\validate\Address;

        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $address->consignee = $data['consignee'];
        $address->is_default = $data['is_default'];
        $address->user_id = $session['id'];
        $address->country = '中国';
        $address->province = $data['province'];
        $address->city = $data['city'];
        $address->district = $data['district'];
        $address->address = $data['address'];
        $address->zipcode = $data['zipcode'];
        $address->mobile = $data['mobile'];
        
        if($address->save()){
            $this->redirect('\customer\address\address_list');
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
    public function delete(Address $address)
    {
        if($address->delete()){
            $this->redirect('\customer\address\address_list');
        } else {
            $this->error('删除失败，请联系f8fengh@163.com');
        }
    }
}
