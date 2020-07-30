    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        FusionCharts.ready(function() {

            var workContentChart = new FusionCharts({
                    type: 'pie2d',
                    renderAt: 'project-name-area',
                    width: '295',
                    height: '350',
                    dataFormat: 'json',
                    dataEmptyMessage: "Chưa có dữ liệu",
                    dataSource: {
                        "chart": {
                            "caption": "Phân bố khối theo dự án",
                            "captionFont": "Time New Roman",
                            "showPercentInTooltip": "0",
                            "theme": "fusion",
                            "bgColor": "#282828",
                            "baseFontColor": "#ffffff",
                            "valueFontColor":"#ffffff",
                            "legendItemFontColor": "#ffffff",
                            "toolTipBgColor": "#282828",
                            "showBorder": "0",
                            "showLabels": "1",
                            "legendAllowDrag": "1",
                            "showPercentValues": "0",
                            "showShadow": "1",
                            //"bgalpha":"0",
                            "canvasBgAlpha":"0",
                            "showValues": "0"
                        },
                        "data": [
                            <?php if(!empty($blockFollowPjChart)): ?>
                            <?php $__currentLoopData = $blockFollowPjChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                                "color":  getRandomColor(),
                                "label": "<?php echo e($value->project_name); ?>",
                                "value": '<?php echo e($value->count); ?>',
                                "tooltext": '<?php echo e($value->count); ?>'
                            },
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        ]
                    }
                }).render();


            var projectChart = new FusionCharts({
                    type: 'pie2d',
                    renderAt: 'relate-block-area',
                    width: '295',
                    height: '350',
                    dataFormat: 'json',
                    dataEmptyMessage: "Chưa có dữ liệu",
                    dataSource: {
                        "chart": {
                            "caption": "Phân bố theo khối liên quan",
                            "captionFont": "Time New Roman",
                            "showPercentInTooltip": "0",
                            "theme": "fusion",
                            "bgColor": "#282828",
                            "baseFontColor": "#ffffff",
                            "valueFontColor":"#ffffff",
                            "legendItemFontColor": "#ffffff",
                            "toolTipBgColor": "#282828",
                            "showBorder": "0",
                            "showLabels": "1",
                            "legendAllowDrag": "1",
                            "showPercentValues": "0",
                            "showShadow": "1",
                            //"bgalpha":"0",
                            "canvasBgAlpha":"0",
                            "showValues": "0"
                        },
                        "data": [
                            <?php if(!empty($blockFollowRelateChart)): ?>
                            <?php $__currentLoopData = $blockFollowRelateChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                                "color": getRandomColor(),
                                "label": "<?php echo e($value->block_name); ?>",
                                "value": '<?php echo e($value->count); ?>',
                                "tooltext": '<?php echo e($value->count); ?>'
                            },
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        ]
                    }
            }).render();

            var relateBlockChart = new FusionCharts({
                type: 'pie2d',
                renderAt: 'corporation-name-area',
                width: '295',
                height: '350',
                dataFormat: 'json',
                dataEmptyMessage: "Chưa có dữ liệu",
                dataSource: {
                    "chart": {
                        "caption": "Phân bố dự án theo pháp nhân",
                        "captionFont": "Time New Roman",
                        "showPercentInTooltip": "0",
                        "theme": "fusion",
                        "bgColor": "#282828",
                        "baseFontColor": "#ffffff",
                        "valueFontColor":"#ffffff",
                        "legendItemFontColor": "#ffffff",
                        "toolTipBgColor": "#282828",
                        "showBorder": "0",
                        "showLabels": "1",
                        "legendAllowDrag": "1",
                        "showPercentValues": "0",
                        "showShadow": "1",
                        //"bgalpha":"0",
                        "canvasBgAlpha":"0",
                        "showValues": "0"
                    },

                    "data": [
                            <?php if(!empty($blockFollowCprChart)): ?>
                            <?php $__currentLoopData = $blockFollowCprChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        {
                            "color": getRandomColor(),
                            "label": "<?php echo e($value->corporation_name); ?>",
                            "value": '<?php echo e($value->count); ?>',
                            "tooltext": '<?php echo e($value->count); ?>'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    ]
                }
            }).render();

        });
    </script>
<table class="table table-striped table-hover table-bordered" id="table-employee">
    <?php if(!empty($data)): ?>
        <thead>
            <tr role="row" >
                <th>STT</th>
                <th>Tên dự án</th>
                <th>Khối thực hiện</th>
                <th>Khối liên quan</th>
                
                <?php if(!empty($headerDate)): ?>
                    <?php $__currentLoopData = $headerDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyDate => $valueDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($valueDate); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                     <td><?php echo e($search->row); ?></td>
                    <td><?php echo e($search->project_name); ?></td>
                    <td><?php echo e($search->perform_block); ?></td>
                    <td><?php echo e($search->relate_block); ?></td>
                    <?php if(!empty($from_date) && !empty($to_date)): ?>
                        <?php $__currentLoopData = $search->execute_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td> <?php echo e($value); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <td>
                        <?php echo e($search->total); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        </tbody>
    <?php endif; ?>
</table><?php /**PATH D:\DaoTao\WorkingReport\trunk\20.SourceCode\Modules\StatiscalProject\Providers/../Resources/views/statistic_project_data.blade.php ENDPATH**/ ?>