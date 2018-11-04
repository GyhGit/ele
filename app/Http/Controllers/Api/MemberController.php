<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    //用户注册
    public function reg( Request $request )
    {
        //验证
        $data=$request->post();
        //dd($data);
        $code=Redis::get('tel_'.$data['tel']);
//        dd($code);
        if($data['sms']==$code){
            $data['password']=Hash::make($data['password']);

            if (Member::create($data)) {
                $data = [
                    'status' => "true",
                    'message' => "注册成功 请登录",
                ];
            } else {
                $data = [
                    'status' => false,
                    'message' => "注册失败",
                ];
            }
            return $data;
        }
    }
    
    //获取验证码
    public function sms(Request $request)
    {
        //接收参数
        $tel = $request->get('tel');
        //随机生成验证码
        $code = mt_rand(100000, 999999);
        //存验证码
        Redis::setex("tel_" . $tel, 60, $code);

        //验证码发送给手机
        $config = [
            'access_key' => env("ALIYUNU_ACCESS_ID"),//appID
            'access_secret' => env("ALIYUNU_ACCESS_KEY"),//appKey
            'sign_name' => env("ALIYUN_SIGN_NAME"),//签名
        ];
        $sms = new AliSms();

        $response = $sms->sendSms($tel, 'SMS_149422431', ['code' => $code], $config);


        $data = [

            "status" => true,
            "message" => "获取短信验证码成功" . $code

        ];
        return $data;

    }

    

//登录
    public function login()
    {
        //接收用户名和密码
        $name = \request()->name;
        $password = \request()->password;

        //判断用户名是否存在
        $member = Member::where('username', $name)->first();
        //. 再判断密码是否正确
        if ($member && Hash::check($password, $member->password)) {
            $data = [
                'status' => "true",
                'message' => "登录成功",
                'username' => $name,
                'user_id'=>$member->id,
            ];

        } else {
            $data = [
                'status' => "false",
                'message' => "登录失败",
            ];
        }
        return $data;

    }
    //查看详情
    public function detail(Request $request)
    {
        return Member::find($request->get('user_id'));


    }
    //忘记密码
    public function forget(Request $request){
        //接收参数
        $data=$request->post();
        $code=Redis::get('tel_'.$data['tel']);
        if($data['sms']==$code){
            $tel = $data['tel'];
            $member = Member::where('tel',$tel)->first();
            $data['password']=Hash::make($data['password']);

            if ($member->update($data)) {
                $data = [
                    'status' => "true",
                    'message' => "修改成功 请登录",
                ];
            } else {
                $data = [
                    'status' => false,
                    'message' => "修改失败",
                ];
            }
            return $data;
        }
    }

    //修改密码
    public function change( Request $request){
        $data=$this->validate($request,[
            "oldPassword"=>"required",
            "newPassword"=>"required",
            'id'=>"required"
        ]);
        //旧密码和数据库密码对比
        $oldPassword=$request->post('oldPassword');
        $rePassword=$request->post('newPassword');
        //加密
        $new=Hash::make($rePassword);
        $member = Member::where("id", $data['id'])->first();
        //hash旧密码对比
        if(Hash::check($oldPassword,$member->password)){
            //修改密码
            Member::where('id',$data['id'])->update(['password'=>$new]);
            $data=[
                "status"=>"true",
                "message"=>"修改成功"
            ];
        }else{
            $data=[
                "status"=>"false",
                "message"=>"修改失败"
            ];
        }
        return $data;
    }





}
