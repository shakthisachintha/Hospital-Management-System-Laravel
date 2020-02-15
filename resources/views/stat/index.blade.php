@extends('template.main')

@section('title', $title)

@section('content_title',"General Statistics & Analytics For Year ".$year)
{{-- @section('content_description',"General Analysis About Daily Activites") --}}
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
<script src="bower_components/chart.js/dist/Chart.js"></script>

@if ($year==date('Y'))
    
<div class="row">
    <div class="col-md-12">
        <h4>Summary For ({{date('F, Y')}})</h4><br>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fas fa-user-injured"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Out Patients</span>
                <span class="info-box-number">1,410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-procedures"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">In Patients</span>
                <span class="info-box-number">410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red "><i class="fas fa-user-injured"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Patients</span>
                <span class="info-box-number">13,648</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="far fa-hospital"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Checkings</span>
                <span class="info-box-number">93,139</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Statistics For Year({{$year}})</h3>
            </div>
            <div class="box-body">
                <div>
                    <p class="h4">All below graphs displays statistics for the year {{$year}},to view different years select the
                        year
                        below and submit.</p>
                    <div class="col-xs-4 m-0 p-0">
                        <form class="m-0 p-0 mb-3 mt-3" method="POST" action="{{route('stats_old')}}">
                            @csrf
                            <label for="year">Select Different Year</label>
                            <div class="input-group input-group">
                                <select class="form-control" name="year" id="year">
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                </select>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat">Fetch <i class="fas fa-arrow-right"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Monthly Outpatients Attendance</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="outPatientMonthlyStat" width="400" height="100"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var ctx = document.getElementById("outPatientMonthlyStat").getContext("2d");

var OutPatientData = {
    labels: ["January", "February", "March","April","May","June","July","August","September","October","November","December"],
    datasets: [
        {
            label: "Male",
            backgroundColor: "RGBA(0,83,156,0.81)",
            data: [3,7,4]
        },
        {
            label: "Female",
            backgroundColor: "RGBA(206,91,120,0.51)",
            data: [4,3,5]
        },
        {
            label: "All",
            backgroundColor: "RGBA(63,191,88,0.82)",
            data: [7,2,6]
        }
    ]
};

var outPatientMonthlyStat = new Chart(ctx, {
    type: 'bar',
    data: OutPatientData,
    options: {
        title:{
            text:"Monthly Outpatients Overview",
            display:true,
            position:'top',
            fontSize:16,
        },
        barValueSpacing: 10,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});
</script>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Monthly Inpatients Admissions</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="inPatientMonthlyStat" width="400" height="100"></canvas>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById("inPatientMonthlyStat").getContext("2d");

var InPatientData = {
    labels: ["January", "February", "March","April","May","June","July","August","September","October","November","December"],
    datasets: [
        {
            label: "Male",
            backgroundColor: "RGBA(0,83,156,0.81)",
            data: [3,7,4]
        },
        {
            label: "Female",
            backgroundColor: "RGBA(206,91,120,0.51)",
            data: [4,3,5]
        },
        {
            label: "All",
            backgroundColor: "RGBA(63,191,88,0.82)",
            data: [7,2,6]
        }
    ]
};

var inPatientMonthlyStat = new Chart(ctx, {
    type: 'bar',
    data: InPatientData,
    options: {
        title:{
            text:"Monthly Inpatients Overview",
            display:true,
            position:'top',
            fontSize:16,
        },
        barValueSpacing: 10,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});
</script>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Monthly New Patient Registrations</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="newRegsMonthlyStat" width="400" height="100"></canvas>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>


<script>
    var ctx = document.getElementById("newRegsMonthlyStat").getContext("2d");

var newRegsMonthlyStat = {
    labels: ["January", "February", "March","April","May","June","July","August","September","October","November","December"],
    datasets: [
        {
            label: "Male",
            backgroundColor: "RGBA(0,83,156,0.81)",
            data: [3,7,4]
        },
        {
            label: "Female",
            backgroundColor: "RGBA(206,91,120,0.51)",
            data: [4,3,5]
        },
        {
            label: "All",
            backgroundColor: "RGBA(63,191,88,0.82)",
            data: [7,2,6]
        }
    ]
};

var newRegsMonthlyStat = new Chart(ctx, {
    type: 'bar',
    data: InPatientData,
    options: {
        title:{
            text:"Monthly New Patient Registrations",
            display:true,
            position:'top',
            fontSize:16,
        },
        barValueSpacing: 10,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});
</script>


@endsection

@section('custom_style_sheets')
<link rel="stylesheet" href="bower_components/chart.js/dist/Chart.css">
@endsection

@section('optional_scripts')

@endsection