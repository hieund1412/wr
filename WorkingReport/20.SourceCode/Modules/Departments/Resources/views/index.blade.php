@extends('layouts.app')

@section('title', 'Quản lý phòng ban')

@section('css')
    <style>
        .dataTables_info, .dataTables_length {
            display: none;
        }

        select {
            width: 100%;
        }

        #editabledatatable_new {
            background-color: limegreen;
            color: white;
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
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm mới phòng ban
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: red">&times;</span>
        </button>
        </h5>
    </div>
    <div class="modal-body">
        <form action="{{ route('departments.insert') }}" method="post"
              id="insertDepartment" class="form-horizontal"
              data-bv-message="This value is not valid"
              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            @csrf
            <div class="form-group">
                <label for="block_name_add" class="col-lg-4 control-label">Tên khối <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <select name="block_id" id="block_name_add" class="form-control block_check"
                            data-bv-notempty="true"
                            data-bv-notempty-message="Tên khối không được để trống">
                        <option disabled="disabled" selected="selected" value="">---Chọn Khối---</option>
                        @foreach($getDataBlock as $item)
                            <option value="{{ $item->id }}">{{ $item->block_name }}</option>
                        @endforeach
                    </select>
                    <span class="check-block" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name-depart" class="col-lg-4 control-label">Tên phòng ban <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control department_name_edit_check" id="recipient-name-depart" name="department_name"
                           data-bv-message="Tên không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Tên phòng ban không được để trống"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                           data-bv-regexp-message="Tên phòng ban nhập không đúng giá trị là kí tự và số"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="128"
                           data-bv-stringlength-message="Tên phòng ban nhập tối đa 128 kí tự">
                    <span class="check-department" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-lg-4 control-label">Mô tả:</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="message-text" name="department_note"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="512"
                           data-bv-stringlength-message="Mô tả nhập tối đa 512 kí tự">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd"> Cập nhật</button>
                <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

{{--Edit--}}
<div class="modal fade" id="edit" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="margin:20%">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sửa đổi phòng ban
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: red">&times;</span>
        </button>
        </h5>
    </div>
    <div class="modal-body">
        <form action="{{ route('departments.update') }}" method="post"
              id="editDepartment" class="form-horizontal"
              data-bv-message="This value is not valid"
              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            @csrf
            <input type="hidden" name="id" id="id-edit" value="">
            <div class="form-group">
                <label for="recipient-name-edit" class="col-lg-4 control-label block_check">Tên khối <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <select name="block_id" id="recipient-name-edit">
                        @foreach($getDataBlock as $item)
                            <option value="{{ $item->id }}">{{ $item->block_name }}</option>
                        @endforeach
                    </select>
                    <span class="check-block" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name-depart-edit" class="col-lg-4 control-label">Tên phòng ban <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control department_name_edit_check" id="recipient-name-depart-edit" name="department_name" value=""
                           data-bv-message="Tên không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Tên phòng ban không được để trống"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                           data-bv-regexp-message="Tên phòng ban nhập không đúng giá trị là kí tự và số"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="128"
                           data-bv-stringlength-message="Tên phòng ban nhập tối đa 128 kí tự">
                    <span class="check-department" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text-edit" class="col-lg-4 control-label">Mô tả:</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="message-text-edit" name="department_note" value=""
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="512"
                           data-bv-stringlength-message="Mô tả nhập tối đa 512 kí tự">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
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
    <div class="widget-header " style="line-height: 35px">
        <span class="widget-caption">Danh sách phòng ban</span>
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
        @if(\Illuminate\Support\Facades\Blade::check('role', 'departments.insert'))
            <div class="table-toolbar">
                <a id="editabledatatable_new" class="btn btn-default btn-fill btn-wd" type="button"
                   data-toggle="modal" data-target="#create" data-whatever="@mdo">
                    Thêm mới phòng ban
                </a>
            </div>
        @endif
        @include('layouts.flash_message')
        <table class="table table-striped table-hover table-bordered" id="editabledatatable">
            <thead>
            <tr role="row">
                <th style="background-color: darkgrey">STT</th>
                <th style="background-color: darkgrey">Tên khối</th>
                <th style="background-color: darkgrey">Phòng ban</th>
                <th style="background-color: darkgrey">Mô tả</th>
                @if(\Illuminate\Support\Facades\Blade::check('role', 'departments.update') || \Illuminate\Support\Facades\Blade::check('role', 'departments.destroy'))
                    <th style="width: 159px;background-color: darkgrey">Hành động</th>
                @endif
            </tr>
            </thead>

            <tbody>
            @foreach($getDataDepartment as $key => $depart)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td id="block_name_{{ $depart->id }}" block_id="{{ $depart->block_id }}">{{ $depart->block_name }}</td>
                    <td id="department_name_{{ $depart->id }}">{{ $depart->department_name }}</td>
                    <td id="department_note_{{ $depart->id }}">{{ $depart->department_note }}</td>
                    @if(\Illuminate\Support\Facades\Blade::check('role', 'departments.update') || \Illuminate\Support\Facades\Blade::check('role', 'departments.destroy'))
                        <td>
                            @if(\Illuminate\Support\Facades\Blade::check('role', 'departments.update'))
                                <a href="#" class="btn btn-warning btn-xs edit"
                                   data-toggle="modal"
                                   data-target="#edit" data-whatever="@mdo"
                                   onclick="getData({{ $depart->id }}) ">
                                    <i class="fa fa-edit"></i> Edit</a>
                            @endif
                            @if(\Illuminate\Support\Facades\Blade::check('role', 'departments.destroy'))
                                <a href="#" class="btn btn-danger btn-xs delete"
                                   data-toggle="modal"
                                   data-target="#delete_depart{{$depart->id}}">
                                    <i class="fa fa-trash-o"></i>Delete</a>
                            @endif
                            {{--Delete--}}
                            <div class="modal fade" id="delete_depart{{$depart->id}}" tabindex="-1"
                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style=" margin-left: 20%;width:60%">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thông báo
                                            <button type="button" class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true" style="color: red">&times;</span>
                                            </button>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            Bạn đang chọn chức năng xóa <br>
                                            Bạn có thực sự muốn xóa không ?
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-danger btn-fill btn-wd"
                                               href="{{ route('departments.destroy',['id' => $depart->id]) }}">Xóa</a>
                                            <button type="button" class="btn btn-default btn-fill btn-wd"
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
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#editabledatatable').DataTable({
                language: {
                    search: "",
                    paginate: {previous: "<", next:">"},
                    emptyTable: "Không có dữ liệu"
                }
            });
        });

        function getData(id) {
            var block_name = $('#block_name_' + id).attr('block_id');
            var department_name = $('#department_name_' + id).text();
            var department_note = $('#department_note_' + id).text();
            $('#id-edit').val(id);
            $('#recipient-name-edit').val(block_name);
            $('#recipient-name-depart-edit').val(department_name);
            $('#message-text-edit').val(department_note);
        }

        $(document).ready(function() {
            $("#insertDepartment").bootstrapValidator();
            $("#editDepartment").bootstrapValidator();
        });
        function button() {
            var flag = true;
            var id_check = $('#id-edit').val();
            var department_name_edit = $('#recipient-name-depart-edit').val();
            var department_name_add = $('#recipient-name-depart').val();
            var block_name_add = document.getElementById('block_name_add');
            var block_name_add_option = block_name_add.options[block_name_add.selectedIndex].value;
            var block_name_edit = document.getElementById('recipient-name-edit');
            var block_name_edit_option = block_name_edit.options[block_name_edit.selectedIndex].value;
            if (department_name_edit === '' && department_name_add === '') {
                $('.department_name_edit_check').css('border-color', 'red');
                $('.check-department').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.department_name_edit_check').css('border-color', '');
                $('.check-department').html('');
            }
            if (block_name_add_option === '' && block_name_edit_option === '') {
                $('.block_check').css('border-color', 'red');
                $('.check-block').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.block_check').css('border-color', '');
                $('.check-block').html('');
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('departments.ajaxCheckDuplicate')}}',
                    data: {department_name_edit: department_name_edit,department_name_add: department_name_add, id_check: id_check},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if(data.status === 'success') {
                            if (id_check !== '') {
                                document.getElementById('editDepartment').submit()
                            } else {
                                document.getElementById('insertDepartment').submit()
                            }
                        }
                    }
                })
            }
        }
        $('#create').on('hidden.bs.modal', function (e) {
            $('.department_name_edit_check').css('border-color', '');
            $('.check-department').html('');
            $('.block_check').css('border-color', '');
            $('.check-block').html('');
        });
        $('#edit').on('hidden.bs.modal', function (e) {
            $('.department_name_edit_check').css('border-color', '');
            $('.check-department').html('');
            $('.block_check').css('border-color', '');
            $('.check-block').html('');
        });
    </script>
@endsection


