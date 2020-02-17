@extends('template.main')

@section('title', $title)

@section('content_title',"More Attendance")
@section('content_description',"Get Detailed Reports Of Attendance Of All Users")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
<script src="https://code.jscharting.com/latest/jscharting.js"></script>

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

            {{-- @foreach($att_records as $x)
            [new Date({{$x->year}}, {{$x->month - 1}},{{$x->day}}), {{$x->duration}}],
            @endforeach --}}

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
<div class="box box-info" data-select2-id="14">
    <div class="box-header with-border">
        <h3 class="box-title">Get Attendance By User ID</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('getattendancebyid')}}" method="post">
                    @csrf
                    <div class="col-xs-7">
                        <select class="form-control" style="width: 100%;" aria-hidden="true">
                            {{-- @foreach ($ids as $id)
                            <option>{{$id}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <input type="submit" class="form-control btn btn-success" value="Find">
                    </div>
                </form>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
</div>

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

                    </div>
                </div>
            </div>

        </div>
    </div>

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
