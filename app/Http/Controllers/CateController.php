<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{

    //调整类别顺序方法
    public function getCates(){
        $res=DB::select('select *,concat(path,",",id) as paths from cates order by paths');
        //遍历数据
        foreach($res as $key=>$value){
            // dd($value);
            //拆分数组
            $emp=explode(',',$value->path);
            //计算逗号的个数
            $len=count($emp)-1;
            //修改分类名字
            $res[$key]->name=str_repeat('|——-',$len).$value->name;
        }
        return $res;
    }
    //添加
    public function getAdd(){
        $cates=self::getCates();
        // $cates=DB::table('cates')->get();
        // dd($cates);
        return view('cate.add',['cates'=>$cates]);
    }

    //执行添加
    public function postInsert(Request $request){
        // dd($request->all());
        $data=array();
        //获取pid
        $data=$request->except('_token');
        // dd($data);
        $pid=$request->input('pid');//3
        // dd($pid);
        //判断  如果是顶级分类的话
        if($pid==0){
            $data['path']='0';
        }else{
            //获取父类的信息  方便做path路径的拼接
            $info=DB::table('cates')->where('id','=',$pid)->first();
            // var_dump($data);exit;
            //拼接子类的path
            $data['path']=$info->path.','.$info->id;
        }
        // dd($data);
        $res=DB::table('cates')->insert($data);
        // dd($res);
        if($res){
            return redirect('/admin/cate/index')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    //分页列表操作
    public function getIndex(){
        // $a= DB::table('cates')->get();
        $a=self::getCates();
        return view('cate.index',['a'=>$a]);
    }
}
