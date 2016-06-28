<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertArticleRequest;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getAdd(){
        //解析模板
        return view('article.add',['cates'=>CateController::getLaycates()]);
    }
    //执行添加
    public function postInsert(InsertArticleRequest $request){
        $data=$request->except('_token');
        //文件上传
        //$file= $_FILES['($request->pic)'];
        //dd($request);
        //获取文件后缀
        // $suffix= ltrim(strrchr($request->pic,'.'),'.');
        // $t=File::type('pic');
        // var_dump($t);
        // die();
        // $type= array('image/jpeg','image/png','image/gif','image/jpg');
        // //判断是否是图片类型
        // if(!in_array($suffix,$type)){
        //     return back()->with('error','文件类型不合法');
        // }
        //dd($request);
        //laravel 强大之处  表单验证规则十分方便
        $request ->flash();
        
        if($request->hasFile('pic')){
            //拼接文件名字
            $pathname=md5(time().mt_rand(1,10000)).'.'.$request->file('pic')->getClientOriginalExtension();
            //上传文件
            $request->file('pic')->move(Config::get('app.upload_dir'),$pathname);
            $data['pic']=trim(Config::get('app.upload_dir').$pathname,'.');
            $data['user_id']=1;
            $data['created_at']=date('Y-m-d H:i:s');
            //dd($data);
            //执行添加
            if(DB::table('articles')->insert($data)){
                return redirect('/admin/article/index')->with('success','添加成功');
            }else{
                return back()->with('error','添加失败');
            }
        }        
    }
    //文章的列表
    public  function getIndex(Request $request){
        //获取数据
        $articles=DB::table('articles')->where('title','like','%'.$request->input('keywords').'%')->paginate(5);
        return view('article.index',['articles'=>$articles,'request'=>$request->all()]);
    }

    //修改页面
    public function getEdit($id){
        //获取当前指定id 的文章信息
        $arc=DB::table('articles')->where('id','=',$id)->first();
        return view('article.edit',
            ['arc'=>$arc,
            'cates'=>CateController::getLaycates()

            ]
            );
    }

    //执行修改
    public function postUpdate(InsertArticleRequest $request){
         // dd($request->all());
        $request ->flash();

        $data=$request->except('_token');
        
        if($request->hasFile('pic')){
            //文件上传
        $arc=DB::table('articles')->where('id','=',$request->id)->first();
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
            
            $data['user_id']=1;
            $data['created_at']=date('Y-m-d H:i:s');

            //插入数据库
            if(DB::table('articles')->where('id','=',$request->input('id'))->update($data)){
                return redirect('/admin/article/index')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }
       }
    


 //执行删除
    public function getDelete($id){
        //检测图片
        $arc=DB::table('articles')->where('id','=',$id)->first();
        // dd($arc);
        $path='.'.$arc->pic;
        //判断
        if(file_exists($path)){
            //删除文件夹里面的上传的图片
             unlink($path);
        }
       
        //删除数据库
        if(DB::table('articles')->where('id','=',$id)->delete()){
            return redirect('/admin/article/index')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }   
}

