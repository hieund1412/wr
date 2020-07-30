<style>
    .div_table{
        float: left;
        width: 1400px;
    }
    table{
        border-collapse: collapse;
        font-size: 16px;
        text-align: left;
        float: left;
        width: 1400px;
    }
    th{
        text-align: left;
    }
    tr{
        height: 40px;
    }
    th,td{
        border: 1px solid black;
        padding-left: 12px;
        padding-right: 8px;
        vertical-align: bottom;
    }
    .stt{
        width: 58px;
    }
    .ten{
        width: 110px;
    }
    .khoi{
        width: 112px;
    }
    .tenda{
        width: 140px;
    }
    .noidung{
        width:350px;
    }
    .loaicv{
        /*width: 10%;*/
        width: 140px;
    }
    .manhour{
        width: 98px;
    }
    .hientrang{
        width: 98px;
    }
    .muctieu{
        width: 98px ;
    }
    .ketqua{
        width: 98px;
    }
    .contre{
        width: 98px;
    }
    #texta {
        height: 100px;
    }
    .p_table{
        float: left;
        margin-bottom: 0;
        word-break: break-all;
    }

</style>
{{--Xin Chào ,--}}
{{--<p>Đây là mail report của <i>{{ $user_name }} !</i> ngày {{ $working_date }}</p>--}}
<div class="div_table">
    <table>
            <tr>
                <th class="ten">Tên</th>
                <th class="stt">STT</th>
                <th class="khoi">Khối liên quan</th>
                <th class="tenda">Tên dự án</th>
                <th class="noidung">Nội dung công việc</th>
                <th class="loaicv">Loại công việc</th>
                <th class="manhour" >Thời gian thực hiện(h)</th>
                <th class="hientrang">Hiện trạng(%)</th>
                <th class="muctieu">Mục tiêu</th>
                <th class="ketqua">Kết quả</th>
                <th class="contre">Có trễ</th>
            </tr>
        @php $count = 1; @endphp
        @foreach($data as $item)
            <tr>
                <td ><p class="p_table">{{ $user_name }}</p>  </td>
                <td ><p class="p_table" style="text-align: right">{{ $count++ }}</p> </td>
                <td ><p class="p_table">{{ $item['block_name'] }}</p></td>
                <td ><p class="p_table">{{ $item['project_name'] }}</p></td>
                <td ><p class="p_table">{{ $item['work_content'] }}</p></td>
                <td ><p class="p_table">{{ $item['job_type'] }}</p></td>
                <td ><p class="p_table" style="text-align: right">{{ $item['execute_time'] }}</p> </td>
                <td ><p class="p_table" style="text-align: right">{{ $item['progress'] }}</p></td>
                <td ><p class="p_table">{{ $item['target']}}</p></td>
                <td ><p class="p_table">{{ $item['result'] }}</p></td>
                <td ><p class="p_table">{{ $item['late'] }}</p></td>
            </tr>
        @endforeach
            <tr id="texta">
                <td colspan='11'>
                    <textarea class='col-xs-12 col-md-12' cols='100' rows='5'  placeholder='*Các nội dung khác(vấn đề, lo lắng, liên lạc,...)' readonly>{{$data[0]['note']}}</textarea>
                </td>
            </tr>
    </table>
</div>
<br/>
