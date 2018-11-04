<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    //显示地址列表
    public function index()
    {
        $address = Address::all();

        return $address;
    }

    //添加地址
    public function add(Request $request)
    {
        //接收参数
        $data = $request->post();
        if (Address::create($data)) {

            $data = [
                'status' => "true",
                'message' => "地址添加成功",
            ];
        } else {
            $data = [
                'status' => "false",
                'message' => "地址添加失败",
            ];
        }
        return $data;

    }

    //回显地址
    public function getOne()
    {
        $id = \request()->get("id");
        $address = Address::find($id);
        return $address;

    }

    //修改地址
    public function edit(Request $request)
    {
        $id = request()->get("id");
        $address = Address::find($id);
        $data = $request->all();

        if ($address->update($data)) {
            return [
                'status' => "true",
                'message' => "地址修改成功",

            ];
        } else {
            return [
                'status' => "false",
                'message' => "地址添加失败",
            ];

        }
    }

}
