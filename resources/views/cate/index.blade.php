@extends('layout.index')
@section('content')
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span>分类列表</span>
            </div>
            <div class="mws-panel-body no-padding">
                <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                    <form action="/admin/user/index" method="get">
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>搜索: <input type="text" name="keywords"></label><button class="btn btn-success">搜索</button>
                    </div>

                    </form>
                    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                    ID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 300px;" aria-label="Browser: activate to sort column ascending">
                                    NAME
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 300px;" aria-label="Platform(s): activate to sort column ascending">
                                   PID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10px;" aria-label="Engine version: activate to sort column ascending">
                                    PATH
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                                  操作
                                </th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($a as $k=>$v)
                            <tr class="odd">
                                <td class=" sorting_1">
                                    {{$v->id}}
                                </td>
                                <td class="">
                                    {{$v->name}}
                                </td>
                                <td class="">
                                   {{$v->pid}}
                                </td>
                                <td class="">
                                    {{$v->path}}
                                </td>
                                <td class="">
                                    <a href="/admin/cate/edit/{{$v->id}}" class='btn btn-success'><i class="icon-pencil"></i></a>
                                    &nbsp&nbsp&nbsp&nbsp
                                    <a href="/admin/cate/delete/{{$v->id}}" class='btn btn-info'><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   <!-- 预留分页位<div class="dataTables_paginate paging_full_numbers" id="pages">
                    </div> -->
                    
                </div>
            </div>
        </div>
    </body>
</html>
@endsection