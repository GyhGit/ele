<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PerController extends BaseController
{
    /**权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pers=Permission::all();
        return view("admin.per.index",compact("pers"));
    }

    /**权限添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    //添加权限
    public function add(Request $request){
        //声明一个空数组来装路由名字
        $urls=[];
        //得到所有路由
        $routes = Route::getRoutes();
//        dd($routes);
        //循环得到单个路由
        foreach ($routes as $route){
            //判断是否是后台的命名空间
            if($route->action['namespace']=="App\Http\Controllers\Admin"){
                //取别名存到$urls中
                $urls[]=$route->action['as'];
            }
        }
//        dd($urls[]=$route->action['as']);
        //从数据库取出已存在的
        $pers=Permission::pluck("name")->toArray();
        //已存在的从$urls中去掉
        $urls=array_diff($urls,$pers);
        if($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
            Permission::create($data);
        }
        return view("admin.per.add",compact("urls"));
    }


    public function edit(Request $request,$id)
    {
        //找到id
        $per = Permission::find($id);

        if ($request->isMethod("post")){
            //接收数据
            $data = $request->post();

            if ($per->update($data)) {
                return redirect()->route("admin.per.index")->with("success","修改成功");
            }
        }
        return view("admin.per.edit",compact("per"));


    }

    public function del($id)
    {
        //如果没有找到，会友好提示
        $per = Permission::findOrFail($id);
        if ($per->delete()) {
            return redirect()->route("admin.per.index")->with("success", "删除成功");
        }
    }

}
