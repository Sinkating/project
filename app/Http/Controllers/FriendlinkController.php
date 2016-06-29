<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertFriendlinkRequest;
class FriendlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd(){
        //解析模板
        return view('friendlink.add');
    }
    public function postInsert(InsertFriendlinkRequest $request){
    	 //dd($request->all());
    	$data=$request->except('_token');
    	$request ->flash();

        if($request->hasFile('icon')){
            //拼接文件名字
            $pathname=md5(time().mt_rand(1,10000)).'.'.$request->file('icon')->getClientOriginalExtension();
            //dd($data);
            //上传文件
            $request->file('icon')->move(Config::get('app.upload_dir'),$pathname);
            $data['icon']=trim(Config::get('app.upload_dir').$pathname,'.');
            
            //DB::table('goods')->insert($data);
            if(DB::table('friendlinks')->insert($data)){
                return redirect('/admin/friendlink/index')->with('success','添加成功');
            }else{
                return back()->with('error','添加失败');
            }
        }
    }

    public function getIndex(Request $request){
        // echo "ssss";
        //通过操作数据库去获取数据
        $friendlink=DB::table('friendlinks')->where('name','like','%'.$request->input('keywords').'%')->paginate(5);
        // dd($users);
        // var_dump($admins);
        // die();
        return view('friendlink.index',['friendlink'=>$friendlink,'request'=>$request->all()]);
    }
    public function getEdit($id){
        //获取指定id的商品的信息
        // dd($id);
        $arc=DB::table('friendlinks')->where('id','=',$id)->first();
         //dd($arc);
        return view('friendlink.edit',['arc'=>$arc]);
    }
     //执行修改
    public function postUpdate(InsertFriendlinkRequest $request){
         // dd($request->all());
        $request ->flash();

        $data=$request->except('_token');
        
        if($request->hasFile('icon')){
            //文件上传
        $arc=DB::table('friendlinks')->where('id','=',$request->id)->first();
        // dd($arc);
        $path='.'.$arc->icon;
        //判断
        if(file_exists($path)){
            //删除文件夹里面的上传的图片
             unlink($path);
        }
            //拼接文件名字
            $pathname=md5(time().uniqid().mt_rand(1,10000)).'.'.$request->file('icon')->getClientOriginalExtension();
            // dd($pathname);
            //上传文件
            $request->file('icon')->move(Config::get('app.upload_dir'),$pathname);
            $data['icon']=trim(Config::get('app.upload_dir').$pathname,'.');
        }
            


            //插入数据库
            if(DB::table('friendlinks')->where('id','=',$request->input('id'))->update($data)){
                return redirect('/admin/friendlink/index')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }
       }
    


 //执行删除
    public function getDelete($id){
        //检测图片
        $arc=DB::table('friendlinks')->where('id','=',$id)->first();
        // dd($arc);
        $path='.'.$arc->icon;
        //判断
        if(file_exists($path)){
            //删除文件夹里面的上传的图片
             unlink($path);
        }
       
        //删除数据库
        if(DB::table('friendlinks')->where('id','=',$id)->delete()){
            return redirect('/admin/friendlink/index')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }   
}
