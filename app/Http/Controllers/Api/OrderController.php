<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shops;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;

class OrderController extends Controller
{

    //订单列表
    public function  index(Request$request){
        $orders=Order::where("user_id",$request->input("user_id"))->get();
        $datas=[];
        foreach ($orders as $order){
            $data['id']=$order->id;
            $data['order_code']=$order->sn;
            $data['order_birth_time']=(string)$order->created_at;
            $data['order_status']=$order->order_status;
            $data['shop_id']=$order->shop_id;
            $data['shop_name']=$order->shop->shop_name;
            $data['shop_img']=$order->shop->shop_img;
            $data['order_price']=$order->total;
            $data['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
            $data['goods_list']=$order->goods;
            $datas[]=$data;
        }

//        dd($datas);
        return $datas;
    }






    //添加订单
    public function  add(Request $request){
        //查出收货地址
        $address=Address::find($request->post('address_id'));
        //判断收货地址是否有误
        if($address==null){
            return [
                'status'=>"false",
                'message'=>"收货地址有误"
            ];
        }
        //找到用户id
        $data['user_id']=$request->post("user_id");
        //找到店铺di
        $carts=Cart::where('user_id',$request->post('user_id'))->get();
        //先找购物车第一条数据的商品ID，再通过商品ID在菜品中找出shop_id
        $shopId=Menu::find($carts[0]->goods_id)->shop_id;
        $data['shop_id']=$shopId;
        //生成订单号
        $data['order_code']=date("ymdHis").rand(1000,9999);
        // 地址
        $data['provence']=$address->provence;
        $data['city']=$address->city;
        $data['area']=$address->area;
        $data['detail_address']=$address->detail_address;
        $data['tel']=$address->tel;
        $data['name']=$address->name;
        //总价清零
        $total=0;
        foreach ($carts as $k=>$v){
            $good=Menu::where('id',$v->goods_id)->first();
            //算总价

            $total+=$v->amount*$good->goods_price;
            //dd($total);
        }
        $data['total']=$total;
        $data['status']=0;
        //启动事务
        DB::beginTransaction();
        try{
            //订单入库
            $order=Order::create($data);
            //订单商品
            foreach ($carts as $kk=>$cart) {
                //得到当前菜品
                $menu = Menu::find($cart->goods_id);
                //保存
                $menu->save();
                OrderGood::insert([
                    'order_id' => $order->id,
                    'goods_id' => $cart->goods_id,
                    'amount' => $cart->amount,
                    'goods_name' => $menu->goods_name,
                    'goods_img' => $menu->goods_img,
                    'goods_price' => $menu->goods_price
                ]);
            }
            //清空购物车
            Cart::where('user_id',$request->post('user_id'))->delete();
            //提交事物
           DB::commit();
        }catch (\Exception $exception){
            //回滚
            DB::rollBack();
            return[
                'status'=>"false",
                "message"=>$exception->getMessage(),
            ];
        }
        return[
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id,
        ];

    }
    //订单详情
    public function detail(Request $request){
        $order=Order::find($request->input('id'));
        $data['id']=$order->id;
        $data['order_code']=$order->order_code;
        $data['order_birth_time']=(string)$order->created_at;
        $data['order_status']=$order->order_status;
        $data['shop_id']=$order->shop_id;
        $data['shop_name']=$order->shop->shop_name;
        $data['shop_img']=$order->shop->shop_img;
        $data['order_price']=$order->total;
        $data['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
        $data['goods_list']=$order->goods;
        return $data;

    }

    //支付
    public function pay(Request $request){
        //得到订单
        $order=Order::find($request->post('id'));
        //得到用户
        $member=Member::find($order->user_id);
        //判断钱够不够
        if($order->total > $member->money){
            return [
                'status'=> 'false',
                'message'=>'用户余额不够，请充值'
            ];
        }
        //否则扣钱
        $member->money=$member->money-$order->total;
        $member->save();
        //更改用户状态
        $order->status=1;
        $order->save();


        //通过订单得到店铺名
        $shopId=$order->shop_id;
        //去商户表查出当前的一条 查出当前商铺的用户id
        $user=Shops::where("id",$shopId)->first()->toArray();
        //获得用户id
        $userId=$user['user_id'];
        //通过用户id找出邮箱
        $em=User::where("id",$userId)->first()->toArray();
        //得到用户邮箱
        $email=$em['email'];
        //用户名字
        $name =$em['name'];
        //
        $shopName=$name;
        $to=$email;
        $subject=$shopName.'订单通知';
        \Illuminate\Support\Facades\Mail::send(
            'emails.order',
            compact("shopName"),
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );
        //下单成功给用户发短信
        //得到电话号
        $tel=$order->tel;
        //发短信
        $code="最让你舍不得的平台ele的".$name;
        //4. 把验证码发给手机 用到阿里云短信服务
        $config = [

            'access_key' => env("ALIYUNU_ACCESS_ID"),
            'access_secret' => env("ALIYUNU_ACCESS_KEY"),
            'sign_name' => '个人生活记录',
        ];
        $sms=New AliSms();
//        dd($tel);

        $response = $sms->sendSms($tel, "SMS_150575336", ['name'=> $code], $config);
        //dd($response);

        return [
            'status'=>'true',
            'message'=>"支付成功"
        ];

    }



}
