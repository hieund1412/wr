@extends('layouts.app')

@section('title', 'Cập nhật thông tin người dùng')

@section('css')
    <style>
        .dataTables_info, .dataTables_length {
            display: none;
        }
        select{
            width:100%;
        }
        .form-group {
            margin-top:10%;
        }
        .modal-footer{
            margin-top:5%;
        }
    </style>
@endsection

@section('body')
<div class="page-content">
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Bàn làm việc
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
    @include('layouts.flash_message')
<div class="page-body">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="row">
<div class="wrapper">
<div class="row">
<div class="col-xs-12 col-md-12">
<div class="widget maximized">
<div class="widget-header ">
<span class="widget-caption">Cập nhật thông tin người dùng</span>
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
<form action="{{ route('users.insertView') }}" method="post" id="form_starView"
      class="form-horizontal"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group" style="margin-top: 5%">
                <label for="recipient-name" class="col-lg-4 col-form-label">Tên đăng nhập <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control"
                           id="recipient-name-depart" readonly="readonly"
                           name="user_login" value="{{ \Illuminate\Support\Facades\Auth::user()->user_login }}">
                </div>
            </div>
            <div class="form-group">
                <label for="full_name" class="col-lg-4 col-form-label">Họ tên <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control"
                           id="full_name"
                           name="fullname"
                           data-bv-message="Họ tên không hợp lệ"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Họ tên không được để trống"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="^([A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪ
                                   a-zàáâãèéêếìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ0-9 ]+?)+$"
                           data-bv-regexp-message="Họ tên nhập không đúng giá trị là kí tự và số"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="256"
                           data-bv-stringlength-message="Họ tên nhập tối đa 256 kí tự">
                    <span id="check-full-name" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name-depart" class="col-lg-4 col-form-label">Email <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control"
                           id="email"
                           name="email"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="^([a-zA-Z][a-z0-9_\.]{2,31})@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$"
                           data-bv-regexp-message="Email không đúng định dạng"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Email không được để trống">
                    <span id="check-email" style="color: red"></span>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="message-text" class="col-lg-4 col-form-label">Khối <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <select name="block_id" id="block" class="form-control" data-bv-notempty="true"
                            data-bv-notempty-message="Khối không được để trống">
                        <option selected="selected" value="">---Chọn Khối---</option>
                        @foreach($block as $item)
                            <option value="{{ $item->id }}">{{ $item->block_name }}</option>
                        @endforeach
                    </select>
                    <span id="check-block" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-lg-4 col-form-label">Phòng ban <span style="color:red">*</span> :</label>
                <div class="col-lg-8">
                    <select name="department_id" id="department" class="form-control" data-bv-notempty="true"
                            data-bv-notempty-message="Phòng ban không được để trống">
                        <option selected="selected" value="">---Chọn Phòng ban---</option>
                    </select>
                    <span id="check-depart" style="color: red"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" >
        <div align="center" >
            <button type="button" onclick="validate()" class="btn btn-info btn-fill btn-wd" style="margin-right:5%;">Cập nhật</button>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
                <button type="button" class="btn btn-danger " data-dismiss="modal" >Đóng</button>
            </a>
        </div>
    </div>
</form>
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
            $("#form_starView").bootstrapValidator();
        });
        function validate() {
            var flag = true;
            var id_check = $('#id_check').val();
            var email = $('#email').val();
            var full_name = $('#full_name').val();
            var block_name = document.getElementById('block');
            var block_option = block_name.options[block_name.selectedIndex].value;
            var depart_name = document.getElementById('department');
            var depart_option = depart_name.options[depart_name.selectedIndex].value;
            if (full_name.trim() === '') {
                $('#full_name').css('border-color', 'red');
                $('#check-full-name').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else if (!full_name.match(/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/)) {
                $('#full_name').css('border-color', 'red');
                $('#check-full-name').html('Chỉ được nhập chữ và số');
                flag = false
            } else {
                $('#full_name').css('border-color', '');
                $('#check-full-name').html('');
            }
            if (email.trim() === '') {
                $('#email').css('border-color', 'red');
                $('#check-email').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else if (!email.match(/^([a-zA-Z][a-z0-9_.]{2,31})@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/)) {
                $('#email').css('border-color', 'red');
                $('#check-email').html('Chỉ được nhập chữ và số');
                flag = false
            } else {
                $('#email').css('border-color', '');
                $('#check-email').html('');
            }
            if (block_option === '') {
                $('#block').css('border-color', 'red');
                $('#check-block').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#block').css('border-color', '');
                $('#check-block').html('');
            }
            if (depart_option === '') {
                $('#department').css('border-color', 'red');
                $('#check-depart').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('#department').css('border-color', '');
                $('#check-depart').html('');
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('users.ajax-check-email')}}',
                    data: {email: email, id_check: id_check},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if (data.status === 'success') {
                            document.getElementById('form_starView').submit();
                        }
                    }
                })
            }
        }
        $('#block').change(function () {
            var block_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{route('users.ajax-get-data')}}',
                data: {type: 'block', block_id: block_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_department = new Option('---Chọn Phòng Ban---', '');
                    if (data.length !== 0) {
                        $('#department').attr('disabled', false).empty().append(option_department);
                        data.forEach(function (i) {
                            var option = new Option(i['department_name'], i['id']);
                            $('#department').append(option)
                        })
                    } else {
                        $('#department').empty().append(option_department);
                    }
                }
            })
        });
    </script>
@endsection