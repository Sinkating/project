@extends('layout.index')
@section('content')
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span>用户列表</span>
            </div>
            <div class="mws-panel-body no-padding">
                <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                    <div id="DataTables_Table_1_length" class="dataTables_length">
                        <label>Show <select name="DataTables_Table_1_length" size="1" aria-controls="DataTables_Table_1">
                            <option value="10" selected="selected">
                                10
                            </option>
                            <option value="25">
                                25
                            </option>
                            <option value="50">
                                50
                            </option>
                            <option value="100">
                                100
                            </option>
                        </select> entries</label>
                    </div>
                    <form action="/admin/user/index" method="get">
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label><input type="text" name="keywords"></label><button class="btn btn-success">搜索</button>
                    </div>

                    </form>
                    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row" align="center">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                    ID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 300px;" aria-label="Browser: activate to sort column ascending">
                                    USERNAME
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 300px;" aria-label="Platform(s): activate to sort column ascending">
                                   EMAIL
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 10px;" aria-label="Engine version: activate to sort column ascending">
                                    STATUS
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">
                                  操作
                                </th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all" align="center">
                        	@foreach($admins as $k=>$v)
                            <tr class="odd" >
                                <td class=" sorting_1" >
                                    {{$v->id}}
                                </td>
                                <td class="">
                                    {{$v->username}}
                                </td>
                                <td class="">
                                   {{$v->email}}
                                </td>
                                <td class="">
                                    {{$v->status}}
                                </td>
                                <td class="">
                                    <a href="/admin/user/edit/{{$v->id}}" class='btn btn-success'><i class="icon-pencil"></i></a>
                                    &nbsp&nbsp&nbsp&nbsp
                                    <a href="/admin/user/delete/{{$v->id}}" class='btn btn-info'><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="dataTables_info" id="DataTables_Table_1_info">
                        Showing 1 to 10 of 57 entries
                    </div>
                    <!-- 分页借口 -->
                    <div class="dataTables_paginate paging_full_numbers" id="pages">
                         {!!$admins->appends($request)->render()!!}
                    </div>
                    <!-- <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                        <a class="first paginate_button paginate_button_disabled" tabindex="0" id="DataTables_Table_1_first">First</a><a class="previous paginate_button paginate_button_disabled" tabindex="0" id="DataTables_Table_1_previous">Previous</a><span><a class="paginate_active" tabindex="0">1</a><a class="paginate_button" tabindex="0">2</a><a class="paginate_button" tabindex="0">3</a><a class="paginate_button" tabindex="0">4</a><a class="paginate_button" tabindex="0">5</a></span><a class="next paginate_button" tabindex="0" id="DataTables_Table_1_next">Next</a><a class="last paginate_button" tabindex="0" id="DataTables_Table_1_last">Last</a>
                    </div> -->
                </div>
            </div>
        </div>
    </body>
</html>
@endsection
