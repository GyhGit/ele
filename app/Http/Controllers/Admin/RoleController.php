<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{

    //所有角色
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }


    /**添加角色
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //接收参数
        if ($request->isMethod("post")) {
            //接收参数
            $pers = $request->post('pers');
            //添加角色
            $rele = Role::create([
                "name" => $request->post("name"),
                "guard_name" => "admin"
            ]);
            //角色同步权限
            if ($pers) {
                $rele->syncPermissions($pers);
            }

        }
        //得到所有权限
        $pers = Permission::all();

        return view("admin.role.add", compact("pers"));

    }

    //修改角色
    public function edit(Request $request, $id)
    {

        //得到当前角色
        $roles = Role::find($id);
        //判断提交方式
        $rol = $roles->permissions()->pluck("id")->toArray();


        //判断提交方式
        if ($request->isMethod("post")) {
            //接收参数
            $data['name'] = $request->post('name');
            //创建角色
            $roles->update($data);
            //给角色添加权限 $role->syncPermissions(['权限名1','权限名2']);
            $roles->syncPermissions($request->post('pers'));
            //跳转
            session()->flash("success", "修改成功");
            return redirect("admin/role/index");
        }
        //得到当前权限
        $pers = Permission::all();
        return view("admin.role.edit", compact("roles", "pers", "rol"));
    }

//删除角色
    public function del($id)
    {
        $role = Role::find($id);
        if ($role->delete()) {
            session()->flash("success", "修改成功");
            return redirect("admin/role/index");
        }
    }


}
