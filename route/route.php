<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});
// Route::get('index', 'index/hello');
// Route::get('hello/:name', 'index/hello');

Route::get('index','index/index');

Route::get('login','index/login/index');
Route::post('login','index/login/login');

Route::get('register','index/register/index');
Route::post('register','index/register/save');

Route::group(['name' => 'deliver','prefix' => 'deliver/'],function(){
    Route::get('login','login/index');
    Route::post('login','login/login');

    Route::get('index','index/index');
    Route::get('express/create','express/create');
    Route::post('express/create','express/save');
    Route::get('manage/index','mange/index');

});

Route::group(['name' => 'customer','prefix' => 'customer/'],function(){
    Route::get('login','login/index');
    Route::post('login','login/login');

    Route::get('index/index','index/index');

    // Route::post('order/create','order/save');
    // Route::get('order/edit/:id','order/edit');
    // Route::get('history/index','history/index');
    Route::get('category/index','category/index');
    Route::get('category/itemList/:id','category/itemList')->model('id','app\backend\model\category');
    

    Route::get('shopcar/index','shopcar/index');

    // Route::get('cart','cart/index');
    // Route::get('item/:id','item/index')->model('id','app\backend\model\Item');
    Route::get('item/detail/:id','item/detail')->model('id','app\backend\model\item');
    Route::get('item/ajax_detail','item/ajax_detail');
    Route::post('item/addshopcar','item/addshopcar');

    Route::get('order/confirm','order/confirm');
    Route::get('order/submit_order','order/submit_order');

    Route::get('shopcar/delete','shopcar/delete');
    Route::get('shopcar/one_delete/:id','shopcar/one_delete');
    Route::get('shopcar/ade_one/:id','shopcar/one_delete');
    Route::get('shopcar/reduce_one/:id','shopcar/one_delete');

    Route::get('user/index','user/index');

    Route::get('address/address_list','address/address_list');
    Route::get('address/create','address/create');
    Route::post('address/create','address/save');
    Route::get('address/delete/:id','address/delete')->model('id','app\common\model\Address');
    Route::get('address/edit/:id','address/edit')->model('id','app\common\model\Address');
    Route::put('address/edit/:id','address/update')->model('id','app\common\model\Address');


    
});

Route::group(['name' => 'backend/','prefix' => 'backend/'],function(){
    Route::get('index','index/index');
    Route::get('login','login/index');
    Route::post('login','login/login');
    Route::get('logout','login/logout');

    Route::get('test/index','test/index');
    Route::get('test/my_try','test/my_try');

    Route::get('category/index','category/index');
    Route::get('category/create','category/create');
    Route::post('category/create','category/save');
    Route::get('category/edit/:id','category/edit')->model('id','app\backend\model\Category');
    Route::put('category/edit/:id','category/update')->model('id','app\backend\model\Category');
    Route::get('category/delete/:id','category/delete')->model('id','app\backend\model\Category');

    Route::get('buyer/index','buyer/index');
    Route::get('buyer/create','buyer/create');
    Route::post('buyer/create','buyer/save');
    Route::get('buyer/edit/:id','buyer/edit')->model('id','app\common\model\Buyer');
    Route::put('buyer/edit/:id','buyer/update')->model('id','app\common\model\Buyer');
    Route::get('buyer/delete/:id','buyer/delete')->model('id','app\common\model\Buyer');

    Route::get('dilivery/index','dilivery/index');
    Route::get('dilivery/create','dilivery/create');
    Route::post('dilivery/create','dilivery/save');
    Route::get('dilivery/edit/:id','dilivery/edit')->model('id','app\common\model\Dilivery');
    Route::put('dilivery/edit/:id','dilivery/update')->model('id','app\common\model\Dilivery');
    Route::get('dilivery/delete/:id','dilivery/delete')->model('id','app\common\model\Dilivery');


    Route::get('shopping_records/index','shopping_records/index');
    Route::get('shopping_records/create','shopping_records/create');
    Route::post('shopping_records/create','shopping_records/save');
    Route::get('shopping_records/edit/:id','shopping_records/edit')->model('id','app\common\model\ShoppingRecords');
    Route::put('shopping_records/edit/:id','shopping_records/update')->model('id','app\common\model\ShoppingRecords');
    Route::get('shopping_records/delete/:id','shopping_records/delete')->model('id','app\common\model\ShoppingRecords');
    Route::get('shopping_records/details/:id','shopping_records/details');
    Route::get('shopping_records/records/:express_id','shopping_records/records');
    Route::post('shopping_records/records','shopping_records/save_records');
    Route::get('shopping_records/search_items','shopping_records/search_items');
    Route::get('shopping_records/search_attr','shopping_records/search_items_attr');
    Route::get('shopping_records/stock','shopping_records/stock');

    Route::get('sku/index/:id','sku/index');
    Route::get('sku/add_attr/:id','sku/add_attr');
    Route::post('sku/add_attr','sku/save_attr');

    Route::get('item/index','item/index');
    Route::get('item/create','item/create');
    Route::post('item/create','item/save');
    Route::post('item/upload','item/upload');
    Route::get('item/edit/:id','item/edit')->model('id','app\backend\model\item');
    ROute::put('item/edit/:id','item/update')->model('id','app\backend\model\item');
    ROute::get('item/delete/:id','item/delete')->model('id','app\backend\model\item');
});


return [

];
