@extends('template.main')

@section('title', $title)

@section('content_title',__("My Attendance"))
@section('content_description',__("My Attendance And Holidays Taken"))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["calendar"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn({
            type: 'date',
            id: 'Date'
        });
        dataTable.addColumn({
            type: 'number',
            id: 'Worked Hours'
        });
        dataTable.addRows([

            @foreach($att_records as $x)
            [new Date({{$x->year}}, {{$x->month - 1}},{{$x->day}}), {{$x->duration}}],
            @endforeach

        ]);

        var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

        var options = {
            calendar: {
                cellSize: 20,
                dayOfWeekLabel: {
                    fontName: 'Times-Roman',
                    fontSize: 12,
                    color: 'black',
                    bold: false,
                    italic: false
                },
                monthOutlineColor: {
                    stroke: 'black',
                    strokeOpacity: 0.7,
                    strokeWidth: 2
                },
                noDataPattern: {
                    backgroundColor: '#76a7ff',
                    color: '#76a7fa'
                },
                unusedMonthOutlineColor: {
                    stroke: 'gray',
                    strokeOpacity: 0.8,
                    strokeWidth: 2
                }
            },
            title: "Attendance",
            colorAxis: {
                colors: ['#f25555', '#edf255', '#55b6f2', '#55f27f'],
                // colors: ['present', 'halfday','holliday','absent'],
                maxValue: 10,
                minValue: 0,
                values: [0, 4, 7, 10]

            }
        };

        chart.draw(dataTable, options);
    }

</script>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        {{__('Attendance Calendar')}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="w-100" id="calendar_basic" style="height:25rem"></div>
                        <div class="col-md-9">
                            <p><span class="text-red">*</span>Hours You Worked Are Displayed In The Calander.The Color
                                Changes
                                With The Number Of Hours.</p>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('getyearattendance')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-7">
                                        <input type="number" min="2018" max="{{date('Y')}}" class="form-control" name="year" placeholder="Enter Year">
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="submit" class="form-control btn btn-success" value="Find">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if ($att_more)
    <div class="row">
        <div class="col">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('Attendance Records')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Hours Worked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($att_more as $x)
                            <tr>
                                <td>{{$x->date}}</td>
                                <td>{{$x->start}}</td>
                                <td>{{$x->end}}</td>
                                <td>{{$x->duration}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Hours Worked</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    @endif
</div>
</div>
@endsection

@section('optional_scripts')
<script>
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })

</script>

@endsection
