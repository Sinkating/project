@extends('layout.index')
@section('content')

                  <div class="mws-panel-header">
                      <span>友情链接的添加</span>
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
                      <form action="/admin/friendlink/update" class="mws-form" method="post" enctype="multipart/form-data">
                        <div class="mws-form-inline">
                          <div class="mws-form-row">
                            <label class="mws-form-label">网站名称</label>
                            <div class="mws-form-item">
                              <input type="text" class="small" name="name" value="{{$arc->name}}" >
                            </div>
                          </div>
                          
                          
                          <div class="mws-form-row">
                            <label class="mws-form-label">网站地址</label>
                            <div class="mws-form-item">
                              <textarea class="small" cols="" rows="" name="url" >{{$arc->url}}</textarea>
                            </div>
                          </div>
                          
                          
                          <div class="mws-form-row">
                                        <label class="mws-form-label">网站图标</label>
                                        <div class="mws-form-item">
                                              <img src="{{$arc->icon}}" width="100" height="100">
                                             <input type="file" class="small" name="icon">
                                           
                                        </div>
                                </div>
                          <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">友情链接序号</label>
                                            <input type="text" class="small" name="sort" value="{{$arc->sort}}">
                                            </div>
                                        </div>
                                </div>
                        </div>
                        <div class="mws-button-row">
                          {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$arc->id}}"></input>
                          <input type="submit" class="btn btn-danger" value="提交">
                          <input type="reset" class="btn " value="重置">
                        </div>
                      </form>
                    </div>      
                </div>
                
@endsection