<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//shop 商户
Route::domain('shop.ele.com')->namespace('Shop')->group(function (){
    //显示首页
    Route::get("shop/user/index","UserController@index")->name("shop.user.index");
    //注册
    Route::any("shop/user/reg","UserController@reg")->name("shop.user.reg");
    //登录
    Route::any("shop/user/login","UserController@login")->name("shop.user.login");
    //退出
    Route::any("shop/user/logout","UserController@logout")->name("shop.user.logout");
    //申请
    Route::any("shop/shops/apply","ShopsController@apply")->name("shop.shops.apply");
    //修改个人密码
    Route::any("shop/user/edit","UserController@edit")->name("shop.user.edit");

});
//Admin平台
Route::domain('admin.ele.com')->namespace('Admin')->group(function () {

    //显示首页
    Route::get("admin/admin/index","AdminController@index")->name("admin.admin.index");
    //分类显示
    Route::get("admin/shop_category/index","ShopCategoryController@index")->name("admin.shop_category.index");
//分类添加
    Route::any("admin/shop_category/add","ShopCategoryController@add")->name("admin.shop_category.add");
    //分类编辑
    Route::any("admin/shop_category/edit/{id}","ShopCategoryController@edit")->name("admin.shop_category.edit");
//分类删除
    Route::get("admin/shop_category/del/{id}","ShopCategoryController@del")->name("admin.shop_category.del");
    //申请分类
    Route::get("admin/admin/dispose","AdminController@dispose")->name("admin.admin.dispose");
    //处理
    Route::get("admin/admin/audit/{id}","AdminController@audit")->name("admin.admin.audit");
    //禁用
    Route::get("admin/admin/forbidden/{id}","AdminController@forbidden")->name("admin.admin.forbidden");
    //待审核
    Route::any("admin/admin/check/{id}","AdminController@check")->name("admin.admin.check");
    //admin登录
    Route::any("admin/admin/login","AdminController@login")->name("admin.admin.login");
    //admin退出
    Route::get("admin/admin/logout","AdminController@logout")->name("admin.admin.logout");
    //管理员修改密码
    Route::any("admin/admin/alter","AdminController@alter")->name("admin.admin.alter");
    //用户列表
    Route::get("admin/admin/user","AdminController@user")->name("admin.admin.user");
    //商家默认密码
    Route::get("admin/admin/default/{id}","AdminController@default")->name("admin.admin.default");
    //商家删除
    Route::get("admin/admin/delete/{id}","AdminController@delete")->name("admin.admin.delete");
    //管理员列表显示
    Route::get("admin/admin/main","AdminController@main")->name("admin.admin.main");
    //管理员列表添加
    Route::any("admin/admin/addition","AdminController@addition")->name("admin.admin.addition");
    //管理员列表编辑
    Route::any("admin/admin/redact/{id}","AdminController@redact")->name("admin.admin.redact");
    //管理员删除
    Route::get("admin/admin/rm/{id}","AdminController@rm")->name("admin.admin.rm");




});