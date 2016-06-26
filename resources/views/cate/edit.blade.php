@extends('layout.index')
@section('content')
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>分类修改</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form action="/admin/cate/update" class="mws-form" method="post">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">分类名</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small"  name="name" value="{{$info->name}}">
                    				</div>
                    			</div>
                    			                                  			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">父类名</label>
                    				<div class="mws-form-item">
                    					<select class="small" name="pid">
                    						<option value='0'>请选择</option>
               						    @foreach($cates as $k=>$v)
                                                       <option value="{{$v->id}}" @if($v->id==$info->pid) selected   @endif>{{$v->name}}</option>
               						    @endforeach
                    					</select>
                    				</div>
                    			</div>                    			
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			{{csrf_field()}}
                                   <input type="hidden" name="id" value="{{$info->id}}"></input>
                    			<input type="submit" class="btn btn-danger" value="修改">
                    			<input type="reset" class="btn " value="重置">
                    		</div>
                    	</form>
                    </div>    	
                </div>
@endsection