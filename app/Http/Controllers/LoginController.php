<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
   public function login(){
        return view('admin.login');
   }
   public function dologin(LoginRequest $request){
     //dd($request->all());
    //检测用户
    $admin=DB::table('admins')->where('username','=',$request->input('username'))->first();
    //dd($admin);
    // $a=Hash::make($request->input('password'));
    // //$b=str_random(50);
    // //Hash::make($data['password']);
    // var_dump($admin->password);
    // var_dump($request->input('password'));
    // var_dump($a);
    //检测密码是否一致
    //dd(Hash::check($request->input('password'),$admin->password));
    if(Hash::check($request->input('password'),$admin->password)){
        //设置session数据
        session(['id'=>$admin->id]);
        return redirect('/admin')->with('success','登陆成功');
    }else{
        return back()->with('error','登陆失败');
    }
   }
   public function logout(){
        session()->forget('id');
        return view('admin.login');
   }
}
