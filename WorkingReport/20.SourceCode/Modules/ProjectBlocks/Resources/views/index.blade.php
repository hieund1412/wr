@extends('layouts.app')

@section('title', 'Quản lý dự án theo khối')

@section('css')
    <style>
        .dataTables_length,.dataTables_info{
            display: none;
        }
        #editabledatatable_filter,.dataTables_filter{
            display: none;
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
                                            <span class="widget-caption">Quản lý dự án theo khối</span>
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
                                                <div class="col-xs-3" style="float: left">
                                                    <label for="block_name_search" class="col-xs-5"> Khối thực hiện:</label>
                                                    <select name="block_name_search" class="col-xs-7" id="block_name_search">
                                                        <option value="" selected="selected">--Chọn Khối--</option>
                                                        @foreach($block_name as $projectblock_seacrh)
                                                            <option value="{{ $projectblock_seacrh->block_name }}">{{ $projectblock_seacrh->block_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-3" style="float: left;font-size: 13px">
                                                    <label for="project_name_search" class="col-xs-5"> Tên dự án:</label>
                                                    <input type="text" name="project_name_search" class="col-xs-7" id="project_name_search" style="padding: 6px 12px">
                                                </div>
                                                <div class="col-xs-3" style="float: left">
                                                    <button class="btn btn-primary btn-fill btn-wd" id="search">Tra cứu</button>
                                                </div>
                                            </div>
                                            @if (\Illuminate\Support\Facades\Blade::check('role', 'projectblock.insert'))
                                                <div class="table-toolbar">
                                                <a id="editabledatatable_new" href="#" class="btn btn-success"
                                                   type="button"  data-toggle="modal"
                                                   data-target="#create" data-whatever="@mdo">
                                                    Thêm mới
                                                </a>
                                            </div>
                                            @endif
                                            @include('layouts.flash_message')
                                            <div id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                @include('projectblocks::ajax-table-projectblocks')
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--Edit--}}
                                @if (\Illuminate\Support\Facades\Blade::check('role', 'projectblock.update'))
                                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="margin:20%">
                                            <div class="modal-header" style="background-color: white">
                                                <h5 class="modal-title" id="exampleModalLabel">Sửa đổi dự án theo khối
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <form id="create_projectBlock_form" action="{{ route('projectblock.update') }}" method="post"
                                                      class="form-horizontal bv-form" novalidate="novalidate"
                                                      data-bv-message="This value is not valid"
                                                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-edit" value="">
                                                    <div class="form-group">
                                                            <label for="block_name-edit" class="col-form-label col-lg-4">Khối thực hiện <span style="color:red">*</span></label>
                                                        <div class="col-lg-8">
                                                            <select name="block_id" id="block_name-edit" style="
                                                            width: 100%">
                                                                @foreach($block as $projectblock)
                                                                    <option value="{{ $projectblock->id }}">{{ $projectblock->block_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="check-block" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_name-edit" class="col-form-label col-lg-4">Tên dự án <span style="color:red">*</span></label>
                                                        <div class="col-lg-8">
                                                            <select class="project_check" name="project_id" id="project_name-edit" style="width: 100%">
                                                                @foreach($project as $projectblock)
                                                                    <option value="{{ $projectblock->id }}">{{ $projectblock->project_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="check-project" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text-edit" class="col-form-label col-lg-4">Mô tả dự án:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" id="message-text-edit" name="project_content" value=""
                                                                   data-bv-stringlength="true"
                                                                   data-bv-stringlength-max="512"
                                                                   data-bv-stringlength-message="Không được nhập quá 512 kí tự">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="background-color: white;text-align: center">
                                                        <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                                                        <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{--Insert--}}
                                @if (\Illuminate\Support\Facades\Blade::check('role', 'projectblock.insert'))
                                    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="margin:20%">
                                            <div class="modal-header" style="background-color: white">
                                                <h5 class="modal-title" id="exampleModalLabel">Thêm mới dự án theo khối
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <form id="update_projectBlock_form" action="{{ route('projectblock.insert') }}" method="post"
                                                      data-bv-message="This value is not valid"
                                                      class="form-horizontal bv-form" novalidate="novalidate"
                                                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="block_id" class="col-form-label col-lg-4">Khối thực hiện <span style="color:red">*</span></label>
                                                        <div class="col-lg-8">
                                                            <select name="block_id" id="block_id" style="width: 100%"
                                                                    data-bv-notempty="true"
                                                                    data-bv-notempty-message="không được để trống">
                                                                <option selected="selected" value="">--Chọn Khối--</option>
                                                                @foreach($block as $projectblock)
                                                                    <option value="{{ $projectblock->id }}">{{ $projectblock->block_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="check-block" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_name_add" class="col-form-label col-lg-4">Tên dự án <span style="color:red">*</span></label>
                                                        <div class="col-lg-8">
                                                            <select class="project_check" name="project_id" id="project_name_add" style="width: 100%"
                                                                    data-bv-notempty="true"
                                                                    data-bv-notempty-message="không được để trống">
                                                                <option selected="selected" value="">--Chọn Tên Dự Án--</option>
                                                                @foreach($project as $projectblock)
                                                                    <option value="{{ $projectblock->id }}">{{ $projectblock->project_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="check-project" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label col-lg-4">Mô tả dự án:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" id="message-text" name="project_content"
                                                                   data-bv-stringlength="true"
                                                                   data-bv-stringlength-max="512"
                                                                   data-bv-stringlength-message="Không được nhập quá 512 kí tự">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="background-color: white;text-align: center">
                                                        <button type="button" onclick="button()" class="btn btn-info btn-fill btn-wd"> Cập nhật</button>
                                                        <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng
                                                        </button>
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
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#editabledatatable').DataTable({
                pageLength: 30,
                "columnDefs": [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                language: { search: "" }
            });
            $('#create_projectBlock_form').bootstrapValidator({});
            $('#update_projectBlock_form').bootstrapValidator({});

        } );
        $('#search').click(function () {
            var block_name_search = $('#block_name_search').val();
            var project_name_search = $('#project_name_search').val();
            $.ajax({
                type: 'POST',
                url: '{{route('projectblock.ajaxGetProjectBlock')}}',
                data: {block_name_search: block_name_search, project_name_search: project_name_search},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#editabledatatable_wrapper').html(data);
                }
            })
        });

        function getData(id) {
            var block_name = $('#block_name_' + id).attr('block_id');
            var project_name = $('#project_name_' + id).attr('project_id');
            var project_content = $('#project_content_' + id).attr('project_content');
            $('#id-edit').val(id);
            $('#block_name-edit').val(block_name);
            $('#project_name-edit').val(project_name);
            $('#message-text-edit').val(project_content);
        }
        function button() {
            var flag = true;
            var id_check = $('#id-edit').val();
            var project_name_edit = $('#project_name-edit').val();
            var project_name_add = $('#project_name_add').val();
            var block_edit = document.getElementById('block_name-edit');
            var block_name_edit_option = block_edit.options[block_edit.selectedIndex].value;
            var block_add = document.getElementById('block_id');
            var block_name_add_option = block_add.options[block_add.selectedIndex].value;
            var project_add = document.getElementById('project_name_add');
            var project_name_add_option = project_add.options[project_add.selectedIndex].value;
            var project_edit = document.getElementById('project_name-edit');
            var project_name_edit_option = project_edit.options[project_edit.selectedIndex].value;
            if (block_name_edit_option === '' && block_name_add_option === '') {
                $('.block_check').css('border-color', 'red');
                $('.check-block').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.block_check').css('border-color', '');
                $('.check-block').html('');
            }
            if (project_name_edit_option === '' && project_name_add_option === '') {
                $('.project_check').css('border-color', 'red');
                $('.check-project').html('Vui lòng nhập đủ thông tin');
                flag = false
            } else {
                $('.project_check').css('border-color', '');
                $('.check-project').html('');
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('projects.ajaxCheckDuplicatePjB')}}',
                    data: {project_name_add: project_name_add, project_name_edit: project_name_edit, id_check: id_check},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if(data.status === 'success') {
                            if (id_check !== '') {
                                document.getElementById('create_projectBlock_form').submit()
                            } else {
                                document.getElementById('update_projectBlock_form').submit()
                            }
                        }
                    }
                })
            }

        }
        $('#create').on('hidden.bs.modal', function (e) {
            $('.block_check').css('border-color', '');
            $('.check-block').html('');
            $('.project_check').css('border-color', '');
            $('.check-project').html('');
        });
        $('#edit').on('hidden.bs.modal', function (e) {
            $('.block_check').css('border-color', '');
            $('.check-block').html('');
            $('.project_check').css('border-color', '');
            $('.check-project').html('');
        });
    </script>
@endsection
