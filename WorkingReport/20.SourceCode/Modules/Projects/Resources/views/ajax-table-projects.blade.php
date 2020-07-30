<table class="table table-striped table-hover table-bordered dataTable no-footer"
       id="editabledatatable" role="grid" aria-describedby="editabledatatable_info">
    <thead>
    <tr role="row" >
        <th class="sorting_asc" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1"  style="width: 162px;">STT
        </th>
        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 244px;">Pháp nhân
        </th>
        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 107px;">Tên dự án
        </th>
        <th class="sorting" tabindex="0" aria-controls="editabledatatable" rowspan="1" colspan="1" style="width: 172px;">Mô tả dự án
        </th>
        @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.update') || \Illuminate\Support\Facades\Blade::check('role', 'projects.destroy'))
            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 285px;">Hành động</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @if($data->isNotEmpty())
        @foreach($data as $key => $project)
            <tr role="row" class="odd">
                <td class="sorting_1">{{ $key + 1 }}</td>
                <td scope="row" id="corporation_name_{{$project->id}}" corporation_name="$project->corporation_name">{{ $project->corporation_name }}</td>
                <td scope="row" id="project_name_{{$project->id}}">{{ $project->project_name }}</td>
                <td scope="row" id="project_content_{{$project->id}}">{{ $project->project_note }}</td>
                @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.update') || \Illuminate\Support\Facades\Blade::check('role', 'projects.destroy'))
                    <td>
                        @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.update'))
                            <a href="#" class="btn btn-warning btn-xs edit" data-toggle="modal"
                               data-target="#update_project" data-whatever="@mdo" onclick="getData({{ $project->id }})">
                                <i class="fa fa-edit"></i> Edit</a>
                        @endif
                        @if (\Illuminate\Support\Facades\Blade::check('role', 'projects.destroy'))
                            <a  href="#" class="btn btn-danger btn-xs delete"
                            data-toggle="modal" data-target="#delete_project{{$project->id}}"><i class="fa fa-trash-o"></i> Delete</a>
                        @endif

                        <div class="modal fade" id="delete_project{{$project->id}}" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style=" margin-left: 20%;width:60%">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thông báo
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button></h5>
                                    </div>
                                    <div class="modal-body">
                                        Bạn đang chọn chức năng xóa, Bạn có thực sự muốn xóa không?
                                    </div>

                                    <div class="modal-footer">                                        
                                        <a type="button" class="btn btn-default btn-fill btn-wd" href="{{ route('projects.destroy',['id' => $project['id']]) }}">Xóa</a>
                                        <button type="button" class="btn btn-danger btn-fill btn-wd" data-dismiss="modal">Đóng</button>
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