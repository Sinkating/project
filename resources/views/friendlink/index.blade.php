@extends('layout.index')
@section('content')
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span>文章列表</span>
            </div>
            <div class="mws-panel-body no-padding">
                <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                    <form action="/admin/article/index" method="get">
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label><input type="text" name="keywords" value="{{$request['keywords'] or ''}}"></label><button class="btn btn-success">搜索</button>
                    </div>

                    </form>
                    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 203px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                    ID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 260px;" aria-label="Browser: activate to sort column ascending">
                                    TITLE
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 245px;" aria-label="Platform(s): activate to sort column ascending">
                                   DESCR
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 172px;" aria-label="Engine version: activate to sort column ascending">
                                    PIC
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 172px;" aria-label="Engine version: activate to sort column ascending">
                                    CONTENT
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 127px;" aria-label="CSS grade: activate to sort column ascending">
                                  操作
                                </th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($articles as $k=>$v)
                            <tr class="odd">
                                <td class=" sorting_1">
                                    {{$v->id}}
                                </td>
                                 <td class=" sorting_1">
                                    {{$v->title}}
                                </td>
                                <td class="">
                                    {{$v->descr}}
                                </td>
                                <td class="">
                                   <img src="{{$v->pic}}" width="100px" height="100px">
                                </td>
                                <td class="">
                                   {!!$v->content!!}
                                </td>
                                <td class="">
                                    <a href="/admin/article/edit/{{$v->id}}" class='btn btn-success'><i class="icon-pencil"></i></a>
                                    <a href="/admin/article/delete/{{$v->id}}" class='btn btn-info'><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                    <div class="dataTables_info" id="DataTables_Table_1_info">
                        Showing 1 to 10 of 57 entries
                    </div>

                    <div class="dataTables_paginate paging_full_numbers" id="pages">
                         {!!$articles->render()!!}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection
