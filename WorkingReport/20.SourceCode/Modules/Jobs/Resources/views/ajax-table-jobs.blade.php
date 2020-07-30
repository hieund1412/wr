@php $per = Session::get('permission') @endphp
<table class="table table-striped table-hover table-bordered dataTable no-footer"
       id="editabledatatable" role="grid" aria-describedby="editabledatatable_info">
    <thead>
    <tr role="row">
        <th class="sorting_asc" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 50px;text-align: center;background-color: darkgrey">STT</th>
        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 120px;text-align: center;background-color: darkgrey">Khối thực hiện</th>
        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 159px;text-align: center;background-color: darkgrey">Loại công việc</th>
        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 240px;text-align: center;background-color: darkgrey">Mô tả công việc</th>
        @if(\Illuminate\Support\Facades\Blade::check('role', 'jobs.update') || \Illuminate\Support\Facades\Blade::check('role', 'jobs.destroy'))
            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 159px;text-align: center;background-color: darkgrey">Hành động</th>
        @endif
    </tr>

    </thead>

    <tbody>
    @if($data->isNotEmpty())
        @foreach($data as $key => $jobs)
            <tr role="row" class="odd">
                <td class="sorting_1" style="text-align: center">{{ $key + 1 }}</td>
                <td scope="row" style="text-align: center" id="block_name_{{$jobs->id}}" block_id="{{ $jobs->block_id }}">{{ $jobs->block_name }}</td>
                <td scope="row" id="job_type_{{$jobs->id}}" >{{ $jobs->job_type }}</td>
                <td scope="row" id="job_note_{{$jobs->id}}" >{{ $jobs->job_note }}</td>
                @if(\Illuminate\Support\Facades\Blade::check('role', 'jobs.update') || \Illuminate\Support\Facades\Blade::check('role', 'jobs.destroy'))
                    <td style="text-align: center">
                    @if(\Illuminate\Support\Facades\Blade::check('role', 'jobs.update'))
                        <a href="#" class="btn btn-warning btn-xs edit" data-toggle="modal"
                           data-target="#edit" data-whatever="@mdo" onclick="getData({{ $jobs->id }})"><i class="fa fa-edit"></i> Edit</a>
                    @endif
                    @if(\Illuminate\Support\Facades\Blade::check('role', 'jobs.destroy'))
                        <a  href="#" class="btn btn-danger btn-xs delete"
                            data-toggle="modal" data-target="#delete_job{{$jobs->id}}"><i class="fa fa-trash-o"></i> Delete</a>
                    @endif
                        <div class="modal fade" id="delete_job{{$jobs->id}}" tabindex="-1"
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
                                        <a type="button" class="btn btn-danger btn-fill btn-wd" href="{{ route('jobs.destroy',['id' => $jobs['id']]) }}">Xóa</a>
                                        <button type="button" class="btn btn-default btn-fill btn-wd" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" style="text-align: center">Không có dữ liệu</td>
        </tr>
    @endif
    </tbody>
</table>