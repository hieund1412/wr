<table class="table table-striped table-hover table-bordered" id="table-workflow">
    <thead>
        <tr role="row" class="odd">
            <th style="background-color: darkgrey;width: 1%;text-align: center" >STT</th>
            <th style="background-color: darkgrey;width: 5%;text-align: center" >Ngày</th>
            <th style="background-color: darkgrey;width: 6%;text-align: center" >Khối thực hiện</th>
            <th style="background-color: darkgrey;width: 6%;text-align: center" >Phòng ban</th>
            <th style="background-color: darkgrey;width: 10%;text-align: center" >Họ tên</th>
            <th style="background-color: darkgrey;width: 6%;text-align: center" >Khối liên quan</th>
            <th style="background-color: darkgrey;width: 10%;text-align: center">Tên Dự Án</th>
            <th style="background-color: darkgrey;width: 12%;text-align: center">Nội dung công việc</th>
            <th style="background-color: darkgrey;width: 7%;text-align: center">Loại công việc</th>
            <th style="background-color: darkgrey;width: 5%;text-align: center">Thời gian(h)</th>
            <th style="background-color: darkgrey;width: 5%;text-align: center">Hiện trạng</th>
            <th style="background-color: darkgrey;width: 8%;text-align: center">Mục tiêu</th>
            <th style="background-color: darkgrey;width: 8%;text-align: center">Kết quả</th>
            <th style="background-color: darkgrey;width: 2%;text-align: center">Có trễ?</th>
            <th style="background-color: darkgrey;width: 7%;text-align: center">Vấn đề</th>
            <th style="background-color: darkgrey;width: 2%;text-align: center">Sửa đổi</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $key => $value)
            @php $value = (array)$value @endphp
            <tr role="row" class="odd reloadRow" id="{{ $value['id'] }}">
                <td style="text-align: center" readonly>{{ $key + 1 }}</td>
                <td style="text-align: center"><p style="display: none">{{strtotime($value['work_date'])}}</p>{{ date('d/m/Y', strtotime($value['work_date'])) }}</td>
                <td style="text-align: center">{{ $value['perform_block'] }}</td>
                <td style="text-align: center">{{ $value['department_name'] }}</td>
                <td style="text-align: center" >{{ $value['fullname'] }}</td>
                <td style="text-align: center">
                    <span class="editSpan reBlock">{{ $value['relation_block']}}</span>
                    <div class="form-group">
                    <select name="relate_block" class="editInput reBlock form-control input-small" style="display: none;width: 100%;height: 36px" data-bv-notempty="true"
                            data-bv-notempty-message="Khối liên quan không được để trống">
                        @foreach($block as $bl)
                        <option value="{{ $bl->id }}" {{ ($bl->id == $value['re_id']) ? 'selected' : '' }}>{{ $bl->block_name }}</option>
                         @endforeach
                    </select>
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pjName">{{ $value['project_name'] }}</span>
                    <div class="form-group">
                    <select name="project_id" class="editInput pjName form-control input-small" style="display: none;width: 100%;height: 36px;" data-bv-notempty="true"
                            data-bv-notempty-message="Tên dự án không được để trống">
                    @foreach($project as $pj)
                            <option value="{{ $pj->id }}" {{ ($pj->id == $value['project_id']) ? 'selected' : '' }}>{{ $pj->project_name }}</option>
                    @endforeach
                    </select>
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan workCon">{{ $value['work_content'] }}</span>
                    <div class="form-group">
                    <input class="editInput workCon form-control input-small" type="text"
                           name="work_content" value="{{ $value['work_content'] }}" style="display: none; width: 100%;height: 36px;"
                           data-bv-stringlength="true"
                           data-bv-stringlength-max="512"
                           data-bv-stringlength-message="Nội dung nhập tối đa 512 kí tự"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Nội dung không được để trống">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan workTy">{{ $value['job_type'] }}</span>
                    <div class="form-group">
                    <select name="work_type" class="editInput workTy form-control input-small" style="display: none;width: 100%;height: 36px;" data-bv-notempty="true"
                            data-bv-notempty-message="Loại công việc không được để trống">
                        @foreach($job as $type)
                        <option value="{{ $type->id }}"{{ ($type->id == $value['work_type']) ? 'selected' : '' }}>{{ $type->job_type }}</option>
                            @endforeach
                    </select>
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan exeTime">{{ $value['execute_time'] }}</span>
                    <div class="form-group">
                    <input class="editInput exeTime form-control" type="text"
                           name="execute_time" value="{{ $value['execute_time'] }}" style="display: none;width: 100%;height: 36px"
                           data-bv="true"
                           max="24"
                           data-bv-lessthan-inclusive="true"
                           data-bv-lessthan-message="Thời gian thực hiện nhập giá trị số không trong khoảng từ 0 đến 24"
                           data-bv-regexp="true"
                           data-bv-regexp-regexp="^[0-9.]+$"
                           data-bv-regexp-message="Thời gian thực hiện nhập không đúng định dạng giá trị số và dấu chấm"
                           data-bv-notempty="true"
                           data-bv-notempty-message="Thời gian thực hiện không được để trống">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pro">{{ $value['progress'] }}%</span>
                    <div class="form-group">
                        <input class="editInput pro form-control" type="text"
                               name="progress" value="{{ $value['progress'] }}" style="display: none;width: 100%;height: 36px"
                               data-bv="true"
                               max="100"
                               data-bv-lessthan-inclusive="true"
                               data-bv-lessthan-message="Hiện trạng nhập giá trị số không trong trong khoảng từ 0 đến 100"
                               data-bv-regexp="true"
                               data-bv-regexp-regexp="^[0-9]+$"
                               data-bv-regexp-message="Hiện trạng nhập không đúng giá trị là số"
                               data-bv-notempty="true"
                               data-bv-notempty-message="Hiện trạng không được để trống">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pro">{{ $value['target'] }}</span>
                    <div class="form-group">
                        <input class="editInput pro form-control" type="text"
                               name="target" value="{{ $value['target'] }}" style="display: none;width: 100%;height: 36px;margin: 0 -8px"
                               data-bv-regexp="true"
                               data-bv-regexp-regexp="^[0-9]+$"
                               data-bv-regexp-message="Mục tiêu nhập không đúng giá trị là số"
                               maxlength="10"
                               data-bv-stringlength-message="Mục tiêu nhập tối đa 10 ký tự">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan pro">{{ $value['result'] }}</span>
                    <div class="form-group">
                        <input class="editInput pro form-control" type="text"
                               name="result" value="{{ $value['result'] }}" style="display: none;width: 100%;height: 36px;margin: 0 -8px"
                               data-bv-regexp="true"
                               data-bv-regexp-regexp="^[0-9]+$"
                               data-bv-regexp-message="Kết quả nhập không đúng giá trị là số"
                               maxlength="10"
                               data-bv-stringlength-message="Kết quả nhập tối đa 10 ký tự">
                    </div>
                </td>
                <td style="text-align: center">
                    <span class="editSpan late">
                        @if ($value['late'] == 1)
                            <i class="fa fa-check" style="color: lightskyblue"></i>
                        @endif
                    </span>
                    <label class="editInput late" style="display: none">
                        <div class="form-group">
                        <input type="checkbox" class="colored-blue editInput late" name="late"
                           @if($value['late'] == 1)
                           checked
                           @endif   value="1" >
                        <span class="text" ></span>
                        </div>
                    </label>
                </td>
                <td style="text-align: center">{{ $value['note'] }}</td>
                <td style="text-align: center">
                    <button type="button" class="btn btn-info btn-xs edit" onclick="clickEdit(this);">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <button type="submit" class="btn btn-success btn-xs save" onclick="clickSave(this)" style="display: none">
                        <i class="fa fa-edit"></i> Save
                    </button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("#table-workflow").bootstrapValidator();
        $('#table-workflow').DataTable({
            language: {search: "",
                paginate: {previous: "<",next:">"},
                emptyTable:"Không có dữ liệu"
            },
            pageLength: 50
        });
    });
</script>

