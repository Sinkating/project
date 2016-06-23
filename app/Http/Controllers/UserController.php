<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd(){
        return view('user.add');
    }
    //执行添加
    public function postInsert(Request $request){
        //将请求信息写入闪存
      $request ->flash();
       $this->validate($request, [
        'username' => 'required|max:8|min:4|unique:admins,username',//验证规则
        'password' => 'required',//验证规则
        'repassword' => 'required|same:password',//验证规则
        'email' => 'required|email',//验证规则
        
        ],[
            'username.required'=>'用户名不能为空',//规则的描述
            'username.max'=>'用户名不能超过8位',//规则的描述
            'username.min'=>'用户名不能小于4位',//规则的描述
            'username.unique'=>'用户名已存在',//规则的描述
            'password.required'=>'密码不能为空',//规则的描述
            'repassword.required'=>'确认密码不能为空',//规则的描述
            'repassword.same'=>'两次密码不一致',//规则的的描述
            'email.required'=>'邮箱不能为空',//规则的描述
            'email.email'=>'邮箱的格式不正确',//规则的描述
        ]);

        // dd($request->all());
        // $data['username']=$request->input('username');
        // $data['password']=$request->input('password');
        // $data['email']=$request->input('email');
        // dd($data);
        $data=$request->only(['username','password','email']);
        $data['password']=Hash::make($data['password']);
        $data['token']=str_random(50);//生成50位的随机字串
        // dd($data);
        //执行数据库的添加的操作
        $res=DB::table('admins')->insert($data);
        //判断
        if($res){
            // return view('/admin/user/index');
            return redirect('/admin/user/index')->with('success','添加成功');//跳转操作 
        }else{
            return back()->with('error','添加失败');
        }

    }
    //用户的列表
    public function getIndex(Request $request){
        // echo "ssss";
        //通过操作数据库去获取数据
        $admins=DB::table('admins')->where('username','like','%'.$request->input('keywords').'%')->paginate(4);
        // dd($users);
        return view('user.index',['admins'=>$admins,'request'=>$request->all()]);
    }

    //获取需要修改的信息
    public function getEdit($id){
        // echo "sssss";
        // echo $id;
        //操作数据库
        $a=DB::table('admins')->where('id','=',$id)->first();
        // dd($u);
        return view('user.edit',['a'=>$a]);
    }

    //执行修改
    public function postUpdate(Request $request){
        //获取参数
        $data=$request->only(['username','email']);
        // dd($data);
        $res=DB::table('admins')->where('id','=',$request->input('id'))->update($data);
        // dd($res);
        if($res){
            return redirect('/admin/user/index')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    //执行删除
    public function getDelete($id){
        // echo $id;
        //用数据库做删除的操作
        $res=DB::table('admins')->where('id','=',$id)->delete();
        // dd($res);
        // $res=false;
        if($res){
            //跳转
            return redirect('/admin/user/index')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

}