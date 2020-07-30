@extends('layouts.app')

@section('title', 'Quản lý dự án')

@section('css')
    <style>
        .dataTables_info,.dataTables_length{
            display:none;
        }
        #editabledatatable_filter,.dataTables_filter{
            display: none;
        }
        .col-xs-6 {
            text-align: right;
        }
    </style>
@endsection

@section('body')
    <div class="page-content">
        <div class="page-header position-relative">
            <div class="header-title">
                <h1>
                    Quản lý dự án và công việc
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
                                            <span class="widget-caption">Quản lý dự án</span>
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
                                            <div class="row">
                                                <div class="col-xs-4" style="float: left">
                                                    <label for="corporation_name_search"> Pháp nhân:</label>
                                                    <select name="corporation_name_search" id="corporation_name_search">
                                                        <option selected="selected" value="">---Chọn Pháp Nhân---</option>
                                                        @foreach($corporation_name as $project_search)
                                                            <option value="{{ $project_search->corporation_name }}">{{ $project_search->corporation_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-4" style="float: left;font-size: 13px">
                                                    <label for="project_name_search"> Tên dự án:</label>
                                                    <input type="text" name="project_name_search" id="project_name_search" style="padding: 6px 12px">
                                                </div>
                                                <div class="col-xs-4" style="float: left">
                                                    <button class="btn btn-primary btn-fill btn-wd" id="search">Tra cứu</button>
                                                </div>
                                            </div>
                                            @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.insert'))
                                                <div class="table-toolbar">
                                                    <a id="editabledatatable_new" href="javascript:void(0);" class="btn btn-success"
                                                            type="button"  data-toggle="modal" data-target="#create_project" data-whatever="@mdo">
                                                        Thêm mới dự án
                                                    </a>
                                                </div>
                                            @endif
                                            @include('layouts.flash_message')
                                            <div id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                @include('projects::ajax-table-projects')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--popup insert  project--}}
                            @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.insert'))
                            <div class="modal fade" id="create_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="margin: 20%">
                                        <div class="modal-header" style="background-color: white">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm mới dự án
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br />
                                        @endif
                                        <div class="modal-body">
                                            {{--<form action="{{ route('projects.insert') }}" method="post">--}}
                                            <form id="create_project_form" action="{{ route('projects.insert') }}" method="post"
                                                  class="form-horizontal bv-form" novalidate="novalidate"
                                                  data-bv-message="This value is not valid"
                                                  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                                @csrf
                                                
                                                <div class="form-group">
                                                    <label for="corporation-name" class="col-form-label col-lg-3">Pháp nhân<span style="color:red">*</span>:</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control col-lg-9 corporation_name_check" id="corporation-name" name="corporation_name"
                                                                data-bv-notempty="true"
                                                                data-bv-notempty-message="không được để trống">
                                                            <option disabled="disabled" selected="selected">
                                                                ---Chọn Pháp Nhân---
                                                            </option>
                                                            @foreach($corporation_name as $item)
                                                                <option value="{{ $item->corporation_name }}">{{$item->corporation_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="check-corporation" style="color: red"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="project_name" class="col-form-label col-lg-3">Tên dự án<span style="color:red">*</span>:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control col-lg-9 project_name_check" id="project_name" name="project_name"
                                                               data-bv-message="Tên dự án nhân không hợp lệ"
                                                               data-bv-notempty="true"
                                                               data-bv-notempty-message="Tên dự án không được để trống"
                                                               data-bv-regexp="true"
                                                               data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                                                               data-bv-regexp-message="Tên dự án chỉ có thể bao gồm bảng chữ cái, số, dấu chấm và dấu gạch dưới"
                                                               data-bv-stringlength="true"
                                                               data-bv-stringlength-max="256"
                                                               data-bv-stringlength-message="Tên dự án không được nhập quá 256 kí tự">
                                                        <span class="check-project" style="color: red"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label col-lg-3">Mô tả dự án</label>
                                                    <div class="col-lg-9">
                                                        <textarea class="form-control col-lg-9 project_note_check" id="message-text" name="project_note" rows="3"
                                                                  data-bv-stringlength="true"
                                                                  data-bv-stringlength-max="512"
                                                                  data-bv-stringlength-message="Không được nhập quá 512 kí tự"></textarea>
                                                    </div>
                                                </div>


                                                <div class="modal-footer" style="background-color: white">
                                                    <button type="submit" onclick="button()" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                                                    <button class="btn btn-danger btn-fill btn-wd" aria-label="Close" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{--popup update project--}}
                            @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.update'))
                            <div class="modal fade" id="update_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="margin:20%">
                                            <div class="modal-header" style="background-color: white">
                                            <h5 class="modal-title" id="exampleModalLabel">Sửa đổi dự án
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form id="update_project_form" action="{{ route('projects.update') }}" method="post"
                                                  class="form-horizontal bv-form" novalidate="novalidate"
                                                  data-bv-message="This value is not valid"
                                                  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                                @csrf
                                                <input type="hidden" name="id" id="id-edit" value="">
                                                
                                                <div class="form-group">
                                                    <label for="corporation_name-edit" class="col-form-label col-lg-3">Pháp nhân<span style="color:red">*</span>:</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control col-lg-9 corporation_name_check" id="corporation_name-edit" name="corporation_name">
                                                            @foreach($corporation_name as $item)
                                                                <option value="{{ $item->corporation_name }}">{{$item->corporation_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="check-corporation" style="color: red"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="project_name-edit" class="col-form-label col-lg-3">Tên dự án<span style="color:red">*</span>:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control col-lg-9 project_name_check" id="project_name-edit" name="project_name"
                                                               data-bv-message="Tên dự án nhân không hợp lệ"
                                                               data-bv-notempty="true"
                                                               data-bv-notempty-message="Tên dự án không được để trống"
                                                               data-bv-regexp="true"
                                                               data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                                                               data-bv-regexp-message="Tên dự án chỉ có thể bao gồm bảng chữ cái, số, dấu chấm và dấu gạch dưới"
                                                               data-bv-stringlength="true"
                                                               data-bv-stringlength-max="256"
                                                               data-bv-stringlength-message="Tên dự án không được nhập quá 256 kí tự">
                                                        <span class="check-project" style="color: red"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text-edit" class="col-form-label col-lg-3">Mô tả dự án</label>
                                                    <div class="col-lg-9">
                                                        <textarea type="text" class="form-control project_note_check" id="message-text-edit" name="project_note" rows="3"
                                                                  data-bv-stringlength="true"
                                                                  data-bv-stringlength-max="512"
                                                                  data-bv-stringlength-message="Không được nhập quá 512 kí tự"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background-color: white">
                                                    <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                                                    <button class="btn btn-danger btn-fill btn-wd" aria-label="Close" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#create_project_form').bootstrapValidator({});
            $('#update_project_form').bootstrapValidator({});
            // $('#editabledatatable').DataTable();
            $('#editabledatatable').DataTable( {
                pageLength: 30,
                "columnDefs": [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                language: { search: "" }
            } );
        });
        $('#search').click(function () {
            var corporation_name_search = $('#corporation_name_search').val();
            var project_name_search = $('#project_name_search').val();
            $.ajax({
                type: 'POST',
                url: '{{route('projects.ajaxGetProjects')}}',
                data: {corporation_name_search: corporation_name_search, project_name_search:project_name_search},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#editabledatatable_wrapper').html(data);
                }
            })
        });
        function button() {
            var flag = true;
            var id_check = $('#id-edit').val();
            var project_name_add = $('#project_name').val();
            var project_name_edit = $('#project_name-edit').val();
            var corporation_edit = document.getElementById('corporation_name-edit');
            var corporation_edit_option = corporation_edit.options[corporation_edit.selectedIndex].value;
            var corporation_add =  document.getElementById('corporation-name');
            var corporation_add_option = corporation_add.options[corporation_add.selectedIndex].value;
            if (project_name_add === '' && project_name_edit === '') {
                $('.project_name_check').css('border-color', 'red');
                $('.check-project').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.project_name_check').css('border-color', '');
                $('.check-project').html('');
            }
            if (corporation_edit_option === '' && corporation_add_option === '') {
                $('.corporation_name_check').css('border-color', 'red');
                $('.check-project').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.corporation_name_check').css('border-color', '');
                $('.check-project').html('');
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('projects.ajaxCheckDuplicate')}}',
                    data: {project_name_add: project_name_add,project_name_edit: project_name_edit, id_check: id_check},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if(data.status === 'success') {
                            document.getElementById('update_project_form').submit()
                        }
                    }
                })
            }
        }
        function getData(id) {
        var corporation_name    = $('#corporation_name_'+ id).text();
        var project_name        = $('#project_name_' + id).text();
        var project_note        = $('#project_content_' + id).text();
        $('#id-edit').val(id);
        $('#corporation_name-edit').val(corporation_name);
        $('#project_name-edit').val(project_name);
        $('#message-text-edit').val(project_note);
    }
</script>
@endsection
