@extends('layouts.app')

@section('title', 'Quản lý khối')

@section('css')
    <style>
        #editabledatatable_new {
            background-color: limegreen;
            color: white;
        }
        .dataTables_info, .dataTables_length, .dataTables_filter, .pagination {
            display: none;
        }
    </style>
@endsection

@section('body')
<div class="page-content">
<div class="page-header position-relative">
    <div class="header-title">
        <h1>Quản lý chung</h1>
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
{{--Insert--}}
<div class="modal fade" id="create" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="margin:20%">
    <div class="modal-header" style="background-color: white">
        <h5 class="modal-title" id="exampleModalLabel">Thêm mới Khối
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: red">&times;</span>
        </button>
        </h5>
    </div>
    <div class="modal-body">
        <form action="{{ route('block.insert') }}" method="post"
              id="registrationForm" class="form-horizontal"
              data-bv-message="This value is not valid"
              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            @csrf
            <div id="div-block-name" class="form-group">
                <label for="block_name" class="col-lg-4 control-label">Tên khối <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control block_name_check" id="block_name" name="block_name"
                           data-bv-message="Tên không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Tên khối không được để trống"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                           data-bv-regexp-message="Tên khối nhập không đúng giá trị là kí tự và số"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="128"
                           data-bv-stringlength-message="Tên khối nhập tối đa 128 kí tự">
                    <span class="check-block" style="color: red"></span>
                </div>
            </div>
            <div id="div-block-email" class="form-group">
                <label for="block_email" class="col-lg-4 control-label">Địa chỉ mail<span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="email" class="form-control email_check" id="block_email" name="block_email"
                           data-bv-emailaddress="true"
                           data-bv-emailaddress-message="Địa chỉ mail nhập không đúng định dạng "
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="^([a-zA-Z][a-z0-9_\.]{1,31})@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$"
                           data-bv-regexp-message="Địa chỉ mail không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Địa chỉ mail không được để trống">
                    <span class="check-email" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-lg-4 control-label">Mô tả: </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="message-text" name="block_note"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="512"
                           data-bv-stringlength-message="Mô tả tối đa 512 kí tự">
                </div>
            </div>
            <div class="modal-footer" style="background-color: white">
                <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
{{--End Insert--}}

{{--Edit--}}
<div class="modal fade" id="edit" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="margin:20%">
    <div class="modal-header" style="background-color: white">
        <h5 class="modal-title" id="exampleModalLabel">Sửa đổi Khối
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: red">&times;</span>
        </button>
        </h5>
    </div>
    <div class="modal-body">
        <form action="{{ route('block.update') }}" method="post" id="formEdit"
              class="form-horizontal"
              data-bv-message="This value is not valid"
              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            @csrf
            <input type="hidden" name="id" id="id-edit" value="">
            <div class="form-group">
                <label for="block-name-edit" class="col-lg-4 control-label">Tên khối<span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control block_name_check" id="block-name-edit"
                           name="block_name" value=""
                           data-bv-message="Tên không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Tên khối không được để trống"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                           data-bv-regexp-message="Tên khối nhập không đúng giá trị là kí tự và số"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="128"
                           data-bv-stringlength-message="Tên khối nhập tối đa 128 kí tự">
                    <span class="check-block" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="block_email_edit" class="col-lg-4 control-label">Địa chỉ mail <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control email_check" id="block_email_edit"
                           name="block_email" value=""
                           data-bv-emailaddress="true"
                           data-bv-emailaddress-message="Địa chỉ mail nhập không đúng định dạng"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="^([a-zA-Z][a-z0-9_\.]{1,31})@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$"
                           data-bv-regexp-message="Địa chỉ mail không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Địa chỉ mail không được để trống">
                    <span class="check-email" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text-edit" class="col-lg-4 control-label">Mô tả: </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="message-text-edit" name="block_note" value=""
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="512"
                           data-bv-stringlength-message="Mô tả nhập tối đa 512 kí tự">
                </div>
            </div>
            <div class="modal-footer" style="background-color: white">
                <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd btn-edit">Cập nhật</button>
                <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
{{--End Edit--}}

{{--View--}}
<div class="row">
<div class="col-xs-12 col-md-12">
<div class="widget">
<div class="widget-header">
    <span class="widget-caption">Danh sách khối</span>
        <div class="widget-buttons">
            <a href="#" data-toggle="maximize">
                <i class="fa fa-expand warning"></i>
            </a>
            <a href="#" data-toggle="collapse">
                <i class="fa fa-minus blue"></i>
            </a>
            <a href="#" data-toggle="dispose">
                <i class="fa fa-times danger"></i>
            </a>
        </div>
</div>
<div class="widget-body">
    @if(\Illuminate\Support\Facades\Blade::check('role', 'block.insert'))
        <div class="table-toolbar" style="margin-bottom: 2%">
            <a id="editabledatatable_new" class="btn btn-default  btn-fill btn-wd" onclick="resetData();"
               type="button" data-toggle="modal" data-target="#create" data-whatever="@mdo">
                Thêm mới Khối
            </a>
        </div>
    @endif
    @include('layouts.flash_message')
    <table class="table table-striped table-hover table-bordered" id="editabledatatable">
        <thead>
        <tr role="row" style="column-rule-color:dimgrey">
            <th style="background-color: darkgrey">STT</th>
            <th style="background-color: darkgrey">Tên khối</th>
            <th style="background-color: darkgrey">Mô Tả</th>
            <th style="background-color: darkgrey">Địa chỉ mail</th>
            @if(\Illuminate\Support\Facades\Blade::check('role', 'block.update') || \Illuminate\Support\Facades\Blade::check('role', 'block.destroy'))
                <th style="background-color: darkgrey;width: 159px">Hành Động</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($blockData as $key => $blocks)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td id="block_name_{{$blocks->id}}">{{ $blocks->block_name }}</td>
                <td id="block_note_{{$blocks->id}}">{{ $blocks->block_note }}</td>
                <td id="block_email_{{$blocks->id}}">{{ $blocks->block_email }}</td>
                @if(\Illuminate\Support\Facades\Blade::check('role', 'block.update') || \Illuminate\Support\Facades\Blade::check('role', 'block.destroy'))
                    <td>
                        @if(\Illuminate\Support\Facades\Blade::check('role', 'block.update'))
                            <a href="#" class="btn btn-warning btn-xs edit"
                               data-toggle="modal"
                               data-target="#edit" data-whatever="@mdo"
                               onclick="getData({{$blocks->id}})"><i class="fa fa-edit"></i> Edit</a>
                        @endif
                        @if(\Illuminate\Support\Facades\Blade::check('role', 'block.destroy'))
                            <a href="#" class="btn btn-danger btn-xs delete"
                               data-toggle="modal" data-target="#delete{{$blocks->id}}"><i class="fa fa-trash-o"></i>Delete</a>
                        @endif
                        {{--Delete--}}
                        <div class="modal fade" id="delete{{$blocks->id}}" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="margin-left: 20%;width:60%">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thông báo
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="color: red">&times;</span>
                                        </button>
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        Bạn đang chọn chức năng xóa<br><br>
                                        Bạn có thực sự muốn xóa không ?
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-default btn-fill btn-wd"
                                           href="{{ route('block.destroy',['id' => $blocks->id]) }}">Xóa</a>
                                        <button type="button" class="btn btn-danger btn-fill btn-wd"
                                                data-dismiss="modal">Đóng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--End Delete--}}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
{{--End View--}}
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#registrationForm").bootstrapValidator();
            $("#formEdit").bootstrapValidator();
            $('#editabledatatable').DataTable({
                language: {search: "", emptyTable: "Không có dữ liệu"}
            });
        });
        function getData(id) {
            var block_name = $('#block_name_' + id).text();
            var block_email = $('#block_email_' + id).text();
            var block_note = $('#block_note_' + id).text();
            $('#id-edit').val(id);
            $('#block-name-edit').val(block_name);
            $('#block_email_edit').val(block_email);
            $('#message-text-edit').val(block_note);
        }
        function resetData() {
        $("#block_name").val("");
        $("#block_email").val("");
        $("#message-text").val("");
        $("#div-block-name").attr('class', 'form-group');
        $("#div-block-email").attr('class', 'form-group');
        $("i.form-control-feedback").css('display', 'none');
        $(".help-block").css('display', 'none');
    }
    function button() {
        var flag = true;
        var id_check = $('#id-edit').val();
        var block_name_add = $('#block_name').val();
        var email_add = $('#block_email').val();
        var block_name_edit = $('#block-name-edit').val();
        var email_edit = $('#block_email_edit').val();
        if (block_name_add === '' && block_name_edit === '') {
            $('.block_name_check').css('border-color', 'red');
            $('.check-block').html('Vui lòng nhập đủ thông tin');
            flag = false
        } else {
            $('.block_name_check').css('border-color', '');
            $('.check-block').html('');
        }
        if (email_add.trim() === '' && email_edit.trim() === '') {
            $('.email_check').css('border-color', 'red');
            $('.check-email').html('Vui lòng nhập đủ thông tin');
            flag = false
        } else {
            $('.email_check').css('border-color', '');
            $('.check-department').html('');
        }
        if (flag) {
            $.ajax({
                type: 'POST',
                url: '{{route('block.ajaxCheckDuplicateBlock')}}',
                data: {block_name_add: block_name_add, email_add: email_add, id_check: id_check, block_name_edit: block_name_edit, email_edit: email_edit},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    alert(data.message);
                    if(data.status === 'success') {
                        if (id_check !== ''){
                            document.getElementById('formEdit').submit()
                        } else {
                            document.getElementById('registrationForm').submit()
                        }
                    }
                }
            })
        }
    }
</script>
@endsection