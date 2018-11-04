<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("shops/index","Api\ShopsController@index");
Route::get("shops/detail","Api\ShopsController@detail");
Route::get("member/sms","Api\MemberController@sms");
Route::post("member/reg","Api\MemberController@reg");
Route::post("member/login","Api\MemberController@login");
Route::get("member/detail","Api\MemberController@detail");
Route::post("member/forget","Api\MemberController@forget");
Route::post("member/change","Api\MemberController@change");
//收货地址
Route::get("address/index","Api\AddressController@index");
Route::post("address/add","Api\AddressController@add");
Route::get("address/getOne","Api\AddressController@getOne");
Route::post("address/edit","Api\AddressController@edit");

//购物车
Route::post("cart/add","Api\CartController@add");
Route::get("cart/index","Api\CartController@index");

//添加订单
Route::post("order/add","Api\OrderController@add");
Route::get("order/detail","Api\OrderController@detail");
Route::get("order/index","Api\OrderController@index");
Route::post("order/pay","Api\OrderController@pay");