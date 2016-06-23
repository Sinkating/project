@extends('layout.index')
@section('content')




                    <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>用户添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/user/insert" method="post" class="mws-form">
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
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">用户名:</label>
                              <div class="mws-form-item">
                                   <input value="{{old('username')}}" type="text" class="small" name="username">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" value="{{old('password')}}" name="password" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">确认密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" value="{{old('repassword')}}" name="repassword" class="small">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input value="{{old('email')}}" type="text" name="email" class="small">
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                         {{csrf_field()}}
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection