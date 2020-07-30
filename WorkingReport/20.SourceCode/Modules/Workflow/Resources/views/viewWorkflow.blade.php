@extends('layouts.app')

@section('title', 'Quản lý công việc theo ngày')

@section('css')
    <style>
        .dataTables_info, .dataTables_length, .dataTables_filter {
            display: none;
        }
        input {
            width: 100%;
        }
    </style>
@endsection

@section('body')
<div class="page-content">
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Báo cáo công việc
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
    <div class="widget-header ">
        <span class="widget-caption">Quản lý công việc theo ngày</span>
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
        <form id="workflow_search">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group minHeight">
                        <label for="recipient-name-depart"
                               class="col-lg-3 col-form-label">Thời gian <span style="color:red">*</span> :</label>
                        <div class="col-lg-9" >
                            <div class=" input-group">
                                <span class="input-group-addon">Từ</span>
                                <input type="text" class="form-control date-picker" id="from_date" data-date-format="dd/mm/yyyy"
                                       value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }}">
                                <span class="input-group-addon">Đến</span>
                                <input type="text" class="form-control date-picker" id="to_date" data-date-format="dd/mm/yyyy"
                                       value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group minHeight">
                        <label for="message-text" class="col-lg-3 col-form-label">Phòng:</label>
                        <div class="col-lg-9">
                            <select name="department_name" id="department" class="form-control" >
                                <option value="" selected>---Chọn phòng---</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group minHeight">
                        <label for="message-text" class="col-lg-3 col-form-label">Tiến độ công việc:</label>
                        <div class="col-lg-9">
                            <select name="progress" id="progress" class="form-control" >
                                <option value="" selected>---Chọn tiến độ---</option>
                                <option value="1">Hoàn Thành</option>
                                <option value="0">Chưa hoàn thành</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group minHeight">
                        <label for="message-text" class="col-lg-3 col-form-label">Khối thực hiện <span style="color:red">*</span>:</label>
                        <div class="col-lg-9">
                            <select name="block_name" id="block" class="form-control" data-bv-notempty="true"
                                    data-bv-notempty-message="Khối không được để trống">
                                <option value="" selected>---Chọn khối---</option>
                                @foreach($block as $item)
                                    <option value="{{ $item->id }}">{{ $item->block_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group minHeight">
                        <label for="message-text" class="col-lg-3 col-form-label">Nhân viên:</label>
                        <div class="col-lg-9">
                            <select name="fullname" id="fullname" class="form-control" >
                                <option value="" selected>---Chọn nhân viên---</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group minHeight">
                        <label for="recipient-name-departs"
                               class="col-lg-3 col-form-label">Độ trễ :</label>
                        <div class="col-lg-9">
                            <select name="late" id="late" class="form-control" >
                                <option value="" selected>---Chọn độ trễ---</option>
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" id="search">Tra cứu</button>
                </div>
            </div>
        </form>
        <div id="table_workflow">
            @include('workflow::tableWorkflow')
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
            $("#workflow_search").bootstrapValidator();
            $('#from_date').datepicker({
                endDate: '0d',
                autoclose: 1
            });
            $('#to_date').datepicker({
                endDate: '0d',
                autoclose: 1
            });
            $(".date-picker").keydown(false);
        });

        InitiateEditableDataTable.init();

        $('#block').change(function () {
            var block_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{route('workflow.ajax-get-data')}}',
                data: {type: 'block', block_id: block_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_department = new Option('---Chọn Phòng---', '');
                    var option_fullname = new Option('---Chọn Nhân Viên---', '');
                    if (data.length !== 0) {
                        $('#department').removeAttr('disabled').empty().append(option_department);
                        data.forEach(function (i) {
                            var option = new Option(i['department_name'], i['id']);
                            $('#department').append(option)
                        })
                    } else {
                        $('#department').empty().append(option_department);
                    }
                    $('#fullname').empty().append(option_fullname);
                }
            })
        });

        $('#department').change(function () {
            var block_id = $('#block').val();
            var department_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{route('workflow.ajax-get-data')}}',
                data: {type: 'department', block_id: block_id, department_id: department_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var option_fullname = new Option('---Chọn Nhân Viên---', '');
                    if (data.length !== 0) {
                        $('#fullname').removeAttr('disabled').empty().append(option_fullname);
                        data.forEach(function (i) {
                            var option = new Option(i['fullname'], i['id']);
                            $('#fullname').append(option)
                        })
                    } else {
                        $('#fullname').empty().append(option_fullname);
                    }
                }
            })
        });

        $('#search').click(function () {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var block = $('#block').val();
            if (from_date != "" && to_date != "" && block != "") {
                var fullname = $('#fullname').val();
                var department = $('#department').val();
                var progress = $('#progress').val();
                var late = $('#late').val();
                $.ajax({
                    type: 'POST',
                    url: '{{route('workflow.ajax')}}',
                    data: {
                        fullname: fullname,
                        from_date: from_date,
                        to_date: to_date,
                        block: block,
                        department: department,
                        progress: progress,
                        late: late
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $('#table_workflow').html(data);
                    }
                })
            }
        });

        function clickEdit(col) {
            // $('.edit').on('click', function () {
                $(col).closest("tr").find(".editSpan").hide();
                $(col).closest("tr").find(".editInput").show();
                $(col).closest("tr").find(".edit").hide();
                $(col).closest("tr").find(".save").show();
            // });
        }

        function clickSave(col) {
            // $('.save').on('click', function () {
                var trObj = $(col).closest("tr");
                var ID = $(col).closest("tr").attr('id');
                var inputData = $(col).closest("tr").find(".editInput").serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('workflow.edit') }}',
                    dataType: "json",
                    data: 'action=edit&id=' + ID + '&' + inputData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data.status == true) {
                            alertify.success("Thay đổi trạng thái thành công");
                            $('#search').trigger('click');
                        } else {
                            alertify.error("Thay đổi trạng thái thất bại");
                        }
                    }
                });
             }
    </script>
@endsection

