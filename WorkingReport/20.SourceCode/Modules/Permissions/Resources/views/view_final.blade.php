@extends('layouts.app')

@section('title', empty($data) ? 'Tạo mới nhóm quyền' : 'Sửa đổi nhóm quyền')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <div class="page-content">
        <div class="page-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="wrapper">

                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="widget">
                                        <div class="widget-header ">
                                            @if(empty($data))
                                                <span class="widget-caption">Tạo mới nhóm quyền</span>
                                            @else
                                                <span class="widget-caption">Sửa đổi nhóm quyền</span>
                                            @endif
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
                                            <form method="get" id="create_permission_form">
                                                @csrf
                                                @if(!empty($data))
                                                    <input type="hidden" name="id" id="id-edit" value="">
                                                    @foreach($data as $name)
                                                        <input type="hidden" id="id" value="{{ $name->id }}">
                                                        <label for="permission_name">Tên nhóm <span style="color:red">*</span> :</label>
                                                        <input type="text" class="form-control" id="permission_name" placeholder="Tên nhóm" value="{{ $name->permission_name }}"
                                                               data-bv-notempty="true"
                                                               data-bv-notempty-message="không được để trống">
                                                        <span class="validate-name" style="color: red"></span><br>
                                                        <label for="permission_note">Mô tả :</label>
                                                        <input type="text" class="form-control" id="permission_note" placeholder="Mô tả" value="{{ $name->permission_note }}"
                                                               data-bv-stringlength="true"
                                                               data-bv-stringlength-max="512"
                                                               data-bv-stringlength-message="Không được nhập quá 512 kí tự">
                                                        <span class="validate-length" style="color: red"></span><br>
                                                        <div class="widget collapsed">
                                                            <div class="widget-caption">Phân quyền màn hình</div>

                                                            <div id="tree" at="{{route('permissions.data_tree' ,['id' => $name->id]) }} "></div>

                                                        </div>
                                                        <div class="modal-footer" style="text-align: center">
                                                            <button type="button" id="submit" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                                                            {{--<a href="{{ route('permissions.index') }}">--}}
                                                            <a type="button" href="{{ route('permissions.index') }}" class="btn btn-danger " data-dismiss="modal">
                                                                Quay lại
                                                            </a>
                                                            {{--</a>--}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <input type="hidden" id="id" value="">
                                                    <label for="permission_name">Tên nhóm <span style="color:red">*</span> :</label>
                                                    <input type="text" class="form-control" id="permission_name" placeholder="Tên nhóm"
                                                           data-bv-notempty="true"
                                                           data-bv-notempty-message="không được để trống"
                                                           data-bv-stringlength="true"
                                                           data-bv-stringlength-max="256"
                                                           data-bv-stringlength-message="Không được nhập quá 256 kí tự">
                                                    <span class="validate-name" style="color: red"></span><br>
                                                    <label for="permission_note">Mô tả :</label>
                                                    <input type="text" class="form-control" id="permission_note" placeholder="Mô tả"
                                                           data-bv-stringlength="true"
                                                           data-bv-stringlength-max="512"
                                                           data-bv-stringlength-message="Không được nhập quá 512 kí tự">
                                                    <span class="validate-length" style="color: red"></span><br>
                                                    <div class="widget collapsed">
                                                        <div class="widget-caption">Phân quyền màn hình</div>

                                                        <div id="tree" at="{{route('permissions.data_tree_insert') }} "></div>

                                                    </div>
                                                    <div class="modal-footer" style="text-align: center">
                                                        <button type="button" id="submit" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
                                                        {{--<a href="{{ route('permissions.index') }}">--}}
                                                        <a type="button" href="{{ route('permissions.index') }}" class="btn btn-danger " data-dismiss="modal">
                                                            Quay lại
                                                        </a>
                                                        {{--</a>--}}
                                                    </div>
                                                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready( function () {
            var url = $("#tree").attr("at");
            var tree = $('#tree').tree({
                primaryKey: 'id',
                uiLibrary: 'bootstrap',
                dataSource: url,
                checkboxes: true
            });

            $('#submit').on('click', function () {
                var flag = true;
                var checkedIds = tree.getCheckedNodes();
                var permission_name = $('#permission_name').val();
                var id = $('#id').val();
                var permission_note = $('#permission_note').val();
                if (permission_name.trim() === '') {
                    $('#permission_name').css('border-color', 'red');
                    $('.validate-name').html('Vui lòng nhập đủ thông tin');
                    flag = false
                } else if (permission_name.length > 256) {
                    $('#permission_name').css('border-color', 'red');
                    $('.validate-name').html('Không được quá 256 kí tự');
                    flag = false
                } else if (!permission_name.match(/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/)) {
                    $('#permission_name').css('border-color', 'red');
                    $('.validate-name').html('Chỉ được nhập chữ và số');
                    flag = false
                } else {
                    $('#permission_name').css('border-color', '');
                    $('.validate-name').html('');
                }
                if (permission_note.length > 512) {
                    $('#permission_note').css('border-color', 'red');
                    $('.validate-length').html('Không được quá 512 kí tự');
                    flag = false
                } else {
                    $('#permission_note').css('border-color', '');
                    $('.validate-length').html('');
                }
                if (flag) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('permissions.ajaxGetPermissionScreen')}}',
                        data: {checkedIds: checkedIds, permission_name: permission_name,id: id, permission_note: permission_note},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            if (data.status == 'success') {
                                alert(data.message);
                                window.location.href = '{{ route('permissions.index') }}'
                            }
                            else {
                                alert(data.message);
                            }
                        }
                    })
                }
            });
        });
    </script>
@endsection