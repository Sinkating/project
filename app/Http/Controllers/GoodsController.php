<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertGoodsRequest;
class GoodsController extends Controller
{
    public function getAdd(){
        $cates=CateController::getLaycates();
        return view('goods.add',['cates'=>$cates]);
    }

    public function postInsert(InsertGoodsRequest $request){
        $data=$request->except('_token');
        //dd($data);
        $request ->flash();
        if($request->hasFile('pic')){
            //拼接文件名字
            $pathname=md5(time().mt_rand(1,10000)).'.'.$request->file('pic')->getClientOriginalExtension();
            //上传文件
            $request->file('pic')->move(Config::get('app.upload_dir'),$pathname);
            $data['pic']=trim(Config::get('app.upload_dir').$pathname,'.');
            $data['created_at']=date('Y-m-d H:i:s');
            //dd($data);
            //DB::table('goods')->insert($data);
            if(DB::table('goods')->insert($data)){
                return redirect('/admin/goods/index')->with('success','添加成功');
            }else{
                return back()->with('error','添加失败');
            }
        }
    }
 
    //商品列表
    public function getIndex(){
        // echo "222";
        $goods=DB::table('goods')->join('cates','goods.catesid','=','cates.id')
        ->select(DB::raw('*,cates.name as catesname,goods.name as goodsname,goods.id as goodsid'))
        ->paginate(5);
        // dd($shops);
        return view('goods.index',['goods'=>$goods]);
    }

     public function getEdit($id){
        //获取指定id的商品的信息
        // dd($id);
        $arc=DB::table('goods')->where('id','=',$id)->first();
         //dd($arc);
        return view('goods.edit',[
            'arc'=>$arc,
            'cates'=>CateController::getLaycates()
            ]);
    }
    //执行修改
    public function postUpdate(InsertGoodsRequest $request){
         // dd($request->all());
        $request ->flash();

        $data=$request->except('_token');
        
        if($request->hasFile('pic')){
            //文件上传
        $arc=DB::table('goods')->where('id','=',$request->id)->first();
        // dd($arc);
        $path='.'.$arc->pic;
        //判断
        if(file_exists($path)){
            //删除文件夹里面的上传的图片
             unlink($path);
        }
            //拼接文件名字
            $pathname=md5(time().uniqid().mt_rand(1,10000)).'.'.$request->file('pic')->getClientOriginalExtension();
            // dd($pathname);
            //上传文件
            $request->file('pic')->move(Config::get('app.upload_dir'),$pathname);
            $data['pic']=trim(Config::get('app.upload_dir').$pathname,'.');
        }
            

            $data['created_at']=date('Y-m-d H:i:s');

            //插入数据库
            if(DB::table('goods')->where('id','=',$request->input('id'))->update($data)){
                return redirect('/admin/goods/index')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }
       }
    


 //执行删除
    public function getDelete($id){
        //检测图片
        $arc=DB::table('goods')->where('id','=',$id)->first();
        // dd($arc);
        $path='.'.$arc->pic;
        //判断
        if(file_exists($path)){
            //删除文件夹里面的上传的图片
             unlink($path);
        }
       
        //删除数据库
        if(DB::table('goods')->where('id','=',$id)->delete()){
            return redirect('/admin/goods/index')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }   
}