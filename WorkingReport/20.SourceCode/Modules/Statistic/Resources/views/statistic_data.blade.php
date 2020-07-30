<div>
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
                renderAt: 'work-content-area',
                width: '295',
                height: '350',
                dataFormat: 'json',
                dataEmptyMessage: "Chưa có dữ liệu",
                dataSource: {
                    "chart": {
                        "caption": "Biểu đồ phân bố [Nhân viên] theo loại công việc",
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
                        @if(!empty($workContentChart))
                        @foreach($workContentChart as $key => $value)
                        {
                            "color": getRandomColor(),
                            "label": "{{$value->job_type}}",
                            "value": '{{$value->count}}',
                            "tooltext": '{{$value->count}}'
                        },
                        @endforeach
                        @endif
                    ]
                }
            }).render();

            var projectChart = new FusionCharts({
                type: 'pie2d',
                renderAt: 'project-area',
                width: '295',
                height: '350',
                dataFormat: 'json',
                dataEmptyMessage: "Chưa có dữ liệu",
                dataSource: {
                    "chart": {
                        "caption": "Biểu đồ phân bố [Nhân viên] theo dự án",
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
                        @if(!empty($projectChart))
                        @foreach($projectChart as $key => $value)
                        {
                            "color": getRandomColor(),
                            "label": "{{$value->project_name}}",
                            "value": '{{$value->count}}',
                            "tooltext": '{{$value->count}}'
                        },
                        @endforeach
                        @endif
                    ]
                }
            }).render();

            var relateBlockChart = new FusionCharts({
                type: 'pie2d',
                renderAt: 'relate-block-area',
                width: '295',
                height: '350',
                dataFormat: 'json',
                dataEmptyMessage: "Chưa có dữ liệu",
                dataSource: {
                    "chart": {
                        "caption": "Biểu đồ phân bố [Nhân viên] theo khối liên quan",
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
                        @if(!empty($relateBlockChart))
                        @foreach($relateBlockChart as $key => $value)
                        {
                            "color": getRandomColor(),
                            "label": "{{$value->block_name}}",
                            "value": '{{$value->count}}',
                            "tooltext": '{{$value->count}}'
                        },
                        @endforeach
                        @endif
                    ]
                }
            }).render();
        });
    </script>
</div>
<div>
<table class="table table-striped table-hover table-bordered" id="table-data-area">
    @if(!empty($data))
        <thead>
            <tr role="row" >
                <th>STT</th>
                <th>Tên nhân viên</th>
                <th>Phòng ban</th>
                <th>Loại công việc</th>
                @if(!empty($headerDate))
                    @foreach($headerDate as $keyDate => $valueDate)
                        <th>{{$valueDate}}</th>
                    @endforeach
                @endif
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $search)
                <tr>
                     <td>{{$search->row}}</td>
                    <td>{{$search->fullname}}</td>
                    <td>{{$search->department_name}}</td>
                    <td>{{$search->job_type}}</td>

                    @if(!empty($start_date) && !empty($end_date))
                        @foreach($search->execute_time as $key1 => $value)
                            <td> {{$value}}</td>
                        @endforeach
                    @endif
                    <td>
                        {{$search->total}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
</div>