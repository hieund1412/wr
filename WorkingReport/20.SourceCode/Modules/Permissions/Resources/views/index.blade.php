@extends('layouts.app')

@section('title', 'Quản lý nhóm quyền')

@section('css')
    <style>
        .dataTables_length,.dataTables_info{
            display: none;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <div class="page-content">
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                    Quản lý chung
                </h1>
            </div>
            <!--Header Buttons-->
            <div class="header-buttons">
                <a class="sidebar-toggler" href="#">
                    <i class="fa fa-arrows-h"></i>
                </a>
                <a class="refresh" id="refresh-toggler" href="">
                    <i class="glyphicon glyphicon-refresh"></i>
                </a>
                <a class="fullscreen" id="fullscreen-toggler" href="#">
                    <i class="glyphicon glyphicon-fullscreen"></i>
                </a>
            </div>
            <!--Header Buttons End-->
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="wrapper">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="widget">
                                        <div class="widget-header " style="height: 60px">
                                            <span class="widget-caption">Quản lý nhóm quyền</span>
                                            <div class="widget-buttons">
                                                <a href="#" data-toggle="maximize">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                                <a href="#" data-toggle="collapse">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                                <a href="#" data-toggle="dispose">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="widget-body">
                                            @if(\Illuminate\Support\Facades\Blade::check('role', 'permissions.view'))
                                                <div class="table-toolbar">
                                                    <a id="editabledatatable_new" href="{{ route('permissions.view') }}" class="btn btn-success"
                                                       type="button" >
                                                        Thêm mới nhóm quyền
                                                    </a>
                                                </div>
                                            @endif
                                            <div id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">

                                                <table class="table table-striped table-hover table-bordered dataTable no-footer"
                                                       id="editabledatatable" role="grid" aria-describedby="editabledatatable_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 50px;">STT</th>
                                                        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 120px;">Tên nhóm quyền</th>
                                                        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 240px;">Mô tả</th>
                                                        @if(\Illuminate\Support\Facades\Blade::check('role', 'permissions.edit') || \Illuminate\Support\Facades\Blade::check('role', 'permissions.destroy'))
                                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 159px;">Hành động</th>
                                                        @endif
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($data as $key => $permission)
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">{{ $key + 1 }}</td>
                                                            <td scope="row" id="permission_name_{{$permission->id}}" >{{ $permission->permission_name }}</td>
                                                            <td scope="row" id="permission_note_{{$permission->id}}" >{{ $permission->permission_note }}</td>
                                                            <td>
                                                                @if(\Illuminate\Support\Facades\Blade::check('role', 'permissions.edit'))
                                                                    <a href="{{ route('permissions.edit', ['id' => $permission->id]) }}" class="btn btn-warning btn-xs edit"
                                                                            data-toggle="modal" onclick="getData({{ $permission->id }})">
                                                                        <i class="fa fa-edit"></i> Edit</a>
                                                                @endif
                                                                @if(\Illuminate\Support\Facades\Blade::check('role', 'permissions.destroy'))
                                                                    <a  href="#" class="btn btn-danger btn-xs delete"
                                                                        data-toggle="modal" data-target="#delete_per{{$permission->id}}">
                                                                        <i class="fa fa-trash-o"></i> Delete</a>
                                                                    {{--popup xóa--}}
                                                                    <div class="modal fade" id="delete_per{{$permission->id}}" tabindex="-1"
                                                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content" style=" margin-left: 20%;width:60%">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Thông báo
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Bạn đang chọn chức năng xóa, Bạn có thực sự muốn xóa không?
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <a type="button" class="btn btn-danger btn-fill btn-wd" href="{{ route('permissions.destroy',['id' => $permission['id']]) }}">Xóa</a>
                                                                                    <button type="button" class="btn btn-default btn-fill btn-wd" data-dismiss="modal">Đóng</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function () {
            $('#editabledatatable').DataTable({
                pageLength: 30,
                "columnDefs": [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                language: {search: "",
                    paginate: {previous: "<",next:">"},
                    emptyTable: "Không có dữ liệu"
                }
            });
        });

    </script>
@endsection

