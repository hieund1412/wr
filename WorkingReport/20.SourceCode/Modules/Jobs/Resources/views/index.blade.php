@extends('layouts.app')

@section('title', 'Quản lý loại công việc')

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
                                            <span class="widget-caption">Quản lý loại công việc</span>
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
                                                    <label for="block_name_search"> Khối thực hiện:</label>
                                                    <select name="block_name_search" id="block_name_search">
                                                        <option value="" selected="selected">---Chọn Khối---</option>
                                                        @foreach($block as $block_seacrh)
                                                            <option value="{{ $block_seacrh->id }}">{{ $block_seacrh->block_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-4" style="float: left;font-size: 13px">
                                                    <label for="job_type_search"> Loại công việc:</label>
                                                    <input type="text" name="job_type_search" id="job_type_search" style="padding: 6px 12px">
                                                </div>
                                                <div class="col-xs-4" style="float: left">
                                                    <button class="btn btn-primary btn-fill btn-wd" id="search">Tra cứu</button>
                                                </div>
                                            </div>
                                            <div class="table-toolbar">
                                            @if(\Illuminate\Support\Facades\Blade::check('role', 'jobs.insert'))
                                                <a id="editabledatatable_new" href="#" class="btn btn-success"
                                                        type="button" data-toggle="modal"
                                                        data-target="#create" data-whatever="@mdo">
                                                    Thêm mới
                                                </a>
                                            @endif
                                            </div>
                                            @include('layouts.flash_message')
                                            <div id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                @include('jobs::ajax-table-jobs')
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--Insert--}}
                                <div style="margin: 1%;width: 98%" class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="margin:15%">
                                            <div class="modal-header" style="background-color: white">
                                                <h5 class="modal-title" id="exampleModalLabel">Thêm mới loại công việc
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </h5>

                                            </div>
                                            <div class="modal-body">
                                                <form id="create_jobs_form" action="{{ route('jobs.insert') }}" method="post"
                                                        class="form-horizontal bv-form" novalidate="novalidate"
                                                        data-bv-message="This value is not valid"
                                                        data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                        data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                        data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                                    @csrf
                                                    <div class="form-group" style="margin: 1%;width: 98%">
                                                        <label for="" class="col-form-label col-lg-4">Khối <span style="color:red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <select class="select block_check" id="block_add_check" data-bv-notempty="true"
                                                                    data-bv-notempty-message="Khối không được để trống"
                                                                    name="block_id" id="" style="width: 100%">
                                                                <option selected disabled value="">--Chọn Khối--</option>
                                                                @foreach($block as $block_job)
                                                                    <option value="{{ $block_job->id }}">{{ $block_job->block_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="check-block" style="color: red"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="margin: 1%;width: 98%">
                                                        <label for="recipient-name-depart" class="col-form-label col-lg-4">Loại công việc <span style="color:red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control job_type_check" id="recipient-name-depart"
                                                                    name="job_type"
                                                                    data-bv-message="Loại công việc không hợp lệ"
                                                                    data-bv-notempty="true"
                                                                    data-bv-notempty-message="Loại công việc không được để trống"
                                                                    data-bv-regexp="true"
                                                                    data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                                                                    data-bv-regexp-message="Loại công việc chỉ có thể bao gồm bảng chữ cái, số, dấu chấm và dấu gạch dưới"
                                                                    data-bv-stringlength="true"
                                                                    data-bv-stringlength-max="256"
                                                                    data-bv-stringlength-message="Tên đăng nhập tối đa 256 kí tự">
                                                            <span class="check-job" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin: 1%;width: 98%">
                                                        <label for="message-text" class="col-form-label col-lg-4">Mô tả công việc:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" id="message-text" name="job_note"
                                                                   data-bv-stringlength="true"
                                                                   data-bv-stringlength-max="512"
                                                                   data-bv-stringlength-message="Mô tả nhập tối đa 512 kí tự">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="background-color: white">
                                                        <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd"> Cập nhật</button>
                                                        <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--Edit--}}
                                <div class="modal fade" style="margin: 1%;width: 98%" id="edit" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="margin:15%">
                                            <div class="modal-header" style="background-color: white">
                                                <h5 class="modal-title" id="exampleModalLabel">Sửa đổi loại công việc
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <form id="update_jobs_form" action="{{ route('jobs.update') }}" method="post"
                                                        class="form-horizontal bv-form" novalidate="novalidate"
                                                        data-bv-message="This value is not valid"
                                                        data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                        data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                        data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-edit" value="">
                                                    <div class="form-group" style="margin: 1%;width: 98%">
                                                        <label for="block_name-edit" class="col-form-label col-lg-4">Khối <span style="color:red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <select name="block_id" class="block_check" id="block_name-edit" style="width: 100%">
                                                                @foreach($block as $block_job)
                                                                    <option value="{{ $block_job->id }}">{{ $block_job->block_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="check-block" style="color: red"></span>
                                                    </div>
                                                    </div>
                                                    <div class="form-group" style="margin: 1%;width: 98%">
                                                        <label for="job_type-edit" class="col-form-label col-lg-4">Loại công việc <span style="color:red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control job_type_check" id="job_type-edit" name="job_type"
                                                                    value="" data-bv-field="job_type-edit"
                                                                    data-bv-message="Loại công việc không hợp lệ"
                                                                    data-bv-notempty="true"
                                                                    data-bv-notempty-message="Loại công việc không được để trống"
                                                                    data-bv-regexp="true"
                                                                    data-bv-regexp-regexp="[a-zA-Z0-9_\.]+"
                                                                    data-bv-regexp-message="Loại công việc chỉ có thể bao gồm bảng chữ cái, số, dấu chấm và dấu gạch dưới"
                                                                    data-bv-stringlength="true"
                                                                    data-bv-stringlength-max="256"
                                                                    data-bv-stringlength-message="Tên đăng nhập nhập tối đa 256 kí tự">
                                                            <span class="check-job" style="color: red"></span>
                                                            </div>
                                                        <i class="form-control-feedback" data-bv-icon-for="job_type-edit" style=""></i>
                                                        <i class="form-control-feedback" data-bv-field="job_type-edit" style="display: none;"></i>
                                                    </div>
                                                    <div class="form-group" style="margin: 1%;width: 98%">
                                                        <label for="job_note-edit" class="col-form-label col-lg-4">Mô tả Loại công việc:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" id="job_note-edit" name="job_note"
                                                                   value=""
                                                                   data-bv-stringlength="true"
                                                                   data-bv-stringlength-max="512"
                                                                   data-bv-stringlength-message="Mô tả nhập tối đa 512 kí tự">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="background-color: white">
                                                        <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                                                        <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng
                                                        </button>
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
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#editabledatatable').DataTable({
                "columnDefs": [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                pageLength: 30
            });
            $('#update_jobs_form').bootstrapValidator({});
            $('#create_jobs_form').bootstrapValidator({});
        } );
        $('#search').click(function () {
            var block_name_search = $('#block_name_search').val();
            var job_type_search = $('#job_type_search').val();
            $.ajax({
                type: 'POST',
                url: '{{route('jobs.ajaxGetJobs')}}',
                data: {block_name_search: block_name_search, job_type_search:job_type_search},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#editabledatatable_wrapper').html(data);
                }
            })
        });

        function getData(id) {
            var block_name = $('#block_name_' + id).attr('block_id');
            var job_type = $('#job_type_' + id).text();
            var job_note = $('#job_note_' + id).text();
            $('#id-edit').val(id);
            $('#block_name-edit').val(block_name);
            $('#job_type-edit').val(job_type);
            $('#job_note-edit').val(job_note);
        }

        function button() {
            var flag = true;
            var id_check = $('#id-edit').val();
            var block_name_edit = $('#block_name-edit').val();
            var job_type_edit = $('#job_type-edit').val();
            var block_name_add = $('#block_add_check').val();
            var job_type_add = $('#recipient-name-depart').val();
            var block_name_add_check = document.getElementById('block_add_check');
            var block_name_add_option = block_name_add_check.options[block_name_add_check.selectedIndex].value;
            var block_name_edit_check = document.getElementById('block_add_check');
            var block_name_edit_option = block_name_edit_check.options[block_name_edit_check.selectedIndex].value;
            if (block_name_edit_option === '' && block_name_add_option === '') {
                $('.block_check').css('border-color', 'red');
                $('.check-block').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.block_check').css('border-color', '');
                $('.check-block').html('');
            }
            if (job_type_edit === '' && job_type_add === '') {
                $('.job_type_check').css('border-color', 'red');
                $('.check-job').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.job_type_check').css('border-color', '');
                $('.check-job').html('');
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('projects.ajaxCheckDuplicateJob')}}',
                    data: {block_name_edit: block_name_edit, job_type_edit: job_type_edit, block_name_add: block_name_add, job_type_add: job_type_add, id_check: id_check},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if(data.status === 'success') {
                            if (id_check !== '') {
                                document.getElementById('update_jobs_form').submit()
                            } else {
                                document.getElementById('create_jobs_form').submit()
                            }
                        }
                    }
                })
            }
        }
        $('#create').on('hidden.bs.modal', function (e) {
            $('.block_check').css('border-color', '');
            $('.check-block').html('');
            $('.job_type_check').css('border-color', '');
            $('.check-job').html('');
        });
        $('#edit').on('hidden.bs.modal', function (e) {
            $('.block_check').css('border-color', '');
            $('.check-block').html('');
            $('.job_type_check').css('border-color', '');
            $('.check-job').html('');
        });
    </script>
@endsection
