@extends('layout.index')
@section('content')
<script type="text/javascript" charset="utf-8" src="/b/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/b/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/b/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>文章的添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
		                  @if (count($errors) > 0)
		                  @foreach ($errors->all() as $error)
		                    <div class="mws-form-message error">
		                        <div class="alert alert-danger">
		                            <ul>
		                                    <li>{{ $error }}</li>
		                            </ul>
		                        </div>
		                        
		                    </div>
		                    @endforeach
		                    @endif
                    	<form action="/admin/article/insert" class="mws-form" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">文章标题</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="title" >
                    				</div>
                    			</div>
                    			
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">文章描述</label>
                    				<div class="mws-form-item">
                    					<textarea class="small" cols="" rows="" name="descr" ></textarea>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">文章类别</label>
                    				<div class="mws-form-item">
                    					<select class="small"  name="cate_id">
                    						<option value="0">--请选择--</option>
                    						@foreach($cates as $key=>$v)
                    						<option value="{{$v->id}}">{{$v->name}}</option>
                    						@endforeach
                    					</select>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">文章内容</label>
                    				<div class="mws-form-item">
                    					<script id="editor" type="text/plain" name="content" style="width:600px;height:500px;" >
                    					</script>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                                        <label class="mws-form-label">文章主图</label>
                                        <div class="mws-form-item">
                                             <input type="file" class="small" name="pic">
                                           
                                        </div>
                                   </div>
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			{{csrf_field()}}
                                <input type="hidden" name="id" value=""></input>
                    			<input type="submit" class="btn btn-danger" value="提交">
                    			<input type="reset" class="btn " value="重置">
                    		</div>
                    	</form>
                    </div>    	
                </div>
                <script type="text/javascript">

			    //实例化编辑器
			    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
			    var ue = UE.getEditor('editor');
			    </script>
@endsection