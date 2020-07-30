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
        <?php $count = 1; ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td ><p class="p_table"><?php echo e($user_name); ?></p>  </td>
                <td ><p class="p_table" style="text-align: right"><?php echo e($count++); ?></p> </td>
                <td ><p class="p_table"><?php echo e($item['block_name']); ?></p></td>
                <td ><p class="p_table"><?php echo e($item['project_name']); ?></p></td>
                <td ><p class="p_table"><?php echo e($item['work_content']); ?></p></td>
                <td ><p class="p_table"><?php echo e($item['job_type']); ?></p></td>
                <td ><p class="p_table" style="text-align: right"><?php echo e($item['execute_time']); ?></p> </td>
                <td ><p class="p_table" style="text-align: right"><?php echo e($item['progress']); ?></p></td>
                <td ><p class="p_table"><?php echo e($item['target']); ?></p></td>
                <td ><p class="p_table"><?php echo e($item['result']); ?></p></td>
                <td ><p class="p_table"><?php echo e($item['late']); ?></p></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr id="texta">
                <td colspan='11'>
                    <textarea class='col-xs-12 col-md-12' cols='100' rows='5'  placeholder='*Các nội dung khác(vấn đề, lo lắng, liên lạc,...)' readonly><?php echo e($data[0]['note']); ?></textarea>
                </td>
            </tr>
    </table>
</div>
<br/>
<?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\resources\views/mail/report_mail.blade.php ENDPATH**/ ?>