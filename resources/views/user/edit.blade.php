@extends('layout.index')
@section('content')




                    <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>用户修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin/user/update" method="post" class="mws-form">
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
                                   <input value="{{$a->username}}" type="text" class="small" name="username">
                              </div>
                         </div>
                    
                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input value="{{$a->email}}" type="text" name="email" class="small">
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                          {{csrf_field()}}
                         <input type="hidden" value="{{$a->id}}" name='id'>
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection