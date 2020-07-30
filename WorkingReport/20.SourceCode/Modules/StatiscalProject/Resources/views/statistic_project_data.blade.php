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
                            @if(!empty($blockFollowPjChart))
                            @foreach($blockFollowPjChart as $key => $value)
                            {
                                "color":  getRandomColor(),
                                "label": "{{$value->project_name}}",
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
                            @if(!empty($blockFollowRelateChart))
                            @foreach($blockFollowRelateChart as $key => $value)
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
                            @if(!empty($blockFollowCprChart))
                            @foreach($blockFollowCprChart as $key => $value)
                        {
                            "color": getRandomColor(),
                            "label": "{{$value->corporation_name}}",
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
<table class="table table-striped table-hover table-bordered" id="table-employee">
    @if(!empty($data))
        <thead>
            <tr role="row" >
                <th>STT</th>
                <th>Tên dự án</th>
                <th>Khối thực hiện</th>
                <th>Khối liên quan</th>
                {{--$from_date--}}
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
                    <td>{{$search->project_name}}</td>
                    <td>{{$search->perform_block}}</td>
                    <td>{{$search->relate_block}}</td>
                    @if(!empty($from_date) && !empty($to_date))
                        @foreach($search->execute_time as $key1 => $value)
                            <td> {{$value}}</td>
                        @endforeach
                    @endif
                    <td>
                        {{$search->total}}
                    </td>
                </tr>
            @endforeach
        {{--@php $data->sum('execute_time') @endphp--}}
        </tbody>
    @endif
</table>