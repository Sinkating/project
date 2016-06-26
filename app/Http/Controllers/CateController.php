<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    public $request;
    public function __construct(Request $request){
        $this->request =$request;
    }
    //调整类别顺序方法
    public function getCates(){
        //原始数据查询 分页  使用 对比
        // $res=DB::select('select *,concat(path,",",id) as paths from cates order by paths');
        $res=DB::table('cates')->where("name","like","%".$this->request->input('keywords')."%")->select(DB::raw('*,concat(path,",",id) as paths '))->orderBy('paths')->paginate(15);
        //dd($res);
        //遍历数据
        //$res=$res->toArray();
          // var_dump($res);
          // die();
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
    public function getLaycates(){
        //原始数据查询 分页  使用 对比
         $res=DB::select('select *,concat(path,",",id) as paths from cates order by paths');
        
        //dd($res);
        //遍历数据
        //$res=$res->toArray();
          // var_dump($res);
          // die();
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
        $cates=self::getLaycates();
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
    public function getIndex(Request $request){
        // $a= DB::table('cates')->get();
        $a=self::getCates();
        return view('cate.index',['a'=>$a,'request'=>$request->all()]);
    }
    public function getEdit($id){
        $cates=self::getLaycates();
        $info=DB::table('cates')->where('id','=',$id)->first();
        //return view('cate.edit',['cates'=>DB::table('cates')->get(),'info'=>$info]);
        return view('cate.edit',['cates'=>$cates,'info'=>$info]);
    }
    public function postUpdate(Request $request){
        $data=array();
        $data=$request->except('_token','id');
        $pid= $request->input('pid');//获取pid
        $inputid=$request->input('id');
        // var_dump($inputid);
        // die();
        if($pid==0){
            $data['path']=0;
        }else{
            //根据输入父ID查询得到父类
            $info=DB::table('cates')->where('id','=',$pid)->first();
            //拼接path路径 （新路径等于父类路径+父类ID）
            $data['path']=$info->path.",".$info->id;
            //根据输入ID查询得到输入路径
            $inputpath=DB::table('cates')->where('id','=',$inputid)->first();
           //  var_dump($inputid);
           // die();
            //根据路径和其ID拼接得到查询子类关键词
           $inputkey=$inputpath->path;
           if($inputkey==0){
                $inputkey=$inputkey.','.$inputid;
                var_dump($inputkey);
                //$data['path']=$info->path;
                $newpath=DB::select("select id,path from cates where path like '{$inputkey}%'");
                $repath=array();
               foreach($newpath as $key=>$v){
                    $repath['path']=str_replace(0,$data['path'],$v->path);
                    //var_dump($repath);
                    //echo "<hr/>";
                    $pathresult=DB::table('cates')->where('id','=',$v->id)->update($repath);
                     //echo $v->id."</br>";

               }
             //v
           }
           //var_dump($inputkey);

           //根据关键词替换子类新路径
           //$newpath=array();res=DB::table('cates')->where("name","like","%".$this->request->input('keywords')."%")->select(DB::raw('*,concat(path,",",id) as paths '))->orderBy('paths')
           // $newpath=DB::table('cates')->where("path","like",$inputkey."%");
           // dd($newpath);
           //$newpath=array();
           $newpath=DB::select("select id,path from cates where path like '{$inputkey}%'");
           // var_dump("select path from cates where path like '{$inputkey}%'");
            //var_dump($newpath);
            //var_dump($data);
           $repath=array();
           //die();
           foreach($newpath as $key=>$v){
                $repath['path']=str_replace($inputkey,$data['path'],$v->path);
                //var_dump($repath);
                //echo "<hr/>";
                $pathresult=DB::table('cates')->where('id','=',$v->id)->update($repath);
                 //echo $v->id."</br>";

           }
             //var_dump($data);
            // var_dump($repath);
            // die();
           
        }
        $res=DB::table('cates')->where('id','=',$request->input('id'))->update($data);
        //$res1=DB::table('cates')->where("path","like",'{$inputkey}%')->update($newpath);

        if($res){
            return redirect('/admin/cate/index')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
        //执行删除
        public function getDelete(){
            //检测当前分类下是否含有子类
            $data =DB::table('cates')->where('pid','=',$id)->count();
            if($data>0){
                return back()->with('error','对不起有子类的分类不允许删除');
            }
            //当前类下没有子类的话   执行删除
            $res=DB::table('cates')->where('id','=',$id)->delete();
            if($res){
                return redirect('/admin/cate/index')->with('success','删除成功');
            }else{
                return back()->with('error','删除失败');
            }
        }
}
