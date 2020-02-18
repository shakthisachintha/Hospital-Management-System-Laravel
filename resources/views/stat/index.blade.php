@extends('template.main')

@section('title', $title)

@section('content_title',"General Statistics & Analytics For The Year ".$year)
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
                <span class="info-box-number">{{$out_patients_this_month}}</span>
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
                <span class="info-box-number">{{$in_patients_this_month}}</span>
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
                <span class="info-box-number">{{$new_patient_regs_this_month}}</span>
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
                <span class="info-box-number">{{$total_checkings_this_month}}</span>
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
        <div class="box box-dark">
            <div class="box-header with-border">
                <h3 class="box-title">Patient Statistics For The Year({{$year}})</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div>
                    <p class="h4">All below graphs displays statistics for the year {{$year}},to view different years
                        select the
                        year
                        below and submit.</p>
                    <div class="col-xs-4 m-0 p-0">
                        <form class="m-0 p-0 mb-3 mt-3" method="POST" action="{{route('stats_old')}}">
                            @csrf
                            <label for="year">Select Different Year</label>
                            <div class="input-group input-group">
                                <select class="form-control" name="year" id="year">
                                    <option @if($year==2018) selected @endif value="2018">2018</option>
                                    <option @if($year==2019) selected @endif value="2019">2019</option>
                                    <option @if($year==2020) selected @endif value="2020">2020</option>
                                </select>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat">Fetch <i
                                            class="fas fa-arrow-right"></i></button>
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

                <script>
                    var ctx = document.getElementById("outPatientMonthlyStat").getContext("2d");
                
                var OutPatientData = {
                    labels: ["January", "February", "March","April","May","June","July","August","September","October","November","December"],
                    datasets: [
                        {
                            label: "Male",
                            backgroundColor: "RGBA(0,83,156,0.81)",
                            data: [
                                @php
                                use App\Appointment;
                                $i=1;
                                while($i<13){
                                    echo (Appointment::getMonthCount($year,$i,'Male','OUT'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        },
                        {
                            label: "Female",
                            backgroundColor: "RGBA(206,91,120,0.51)",
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Appointment::getMonthCount($year,$i,'Female','OUT'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        },
                        {
                            label: "All",
                            backgroundColor: "RGBA(63,191,88,0.82)",
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Appointment::getTotalCount($year,$i,'OUT'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
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
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
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
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Appointment::getMonthCount($year,$i,'Male','IN'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        },
                        {
                            label: "Female",
                            backgroundColor: "RGBA(206,91,120,0.51)",
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Appointment::getMonthCount($year,$i,'Female','IN'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        },
                        {
                            label: "All",
                            backgroundColor: "RGBA(63,191,88,0.82)",
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Appointment::getTotalCount($year,$i,'IN'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
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
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
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
                            data: [
                                @php
                                use App\Patients;
                                $i=1;
                                while($i<13){
                                    echo (Patients::regsMonth($year,$i,'Male'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        },
                        {
                            label: "Female",
                            backgroundColor: "RGBA(206,91,120,0.51)",
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Patients::regsMonth($year,$i,'Female'));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        },
                        {
                            label: "All",
                            backgroundColor: "RGBA(63,191,88,0.82)",
                            data: [
                                @php
                                $i=1;
                                while($i<13){
                                    echo (Patients::totalRegs($year,$i));
                                    echo (",");
                                    $i++;
                                }
                                @endphp
                            ]
                        }
                    ]
                };
                
                var newRegsMonthlyStat = new Chart(ctx, {
                    type: 'bar',
                    data: newRegsMonthlyStat,
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
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Medicines Statistics For The Year {{$year}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <p class="h4 mb-4">Below charts show the detailed analysis about medicine usage of the hospital.</p>
                <p class="h4 mb-4">Change the year above to get analytics of previous years</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Most Issued Medicines All Time</h3>

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
                                    <canvas id="medicineDougnet" width="400" height="200"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Most Prescribed Medicines ({{date('F, Y')}})</h3>

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
                                    <canvas id="medicineDougnetMonth" width="400" height="200"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>


<script>
    var ctx = document.getElementById("medicineDougnet").getContext("2d");

    data = {
    datasets: 
    [
        {
            data: 
            [
            @foreach ($top_ten_meds as $medicine)
                @if($medicine->qty>0)
                {{$medicine->qty}},
                @endif
            @endforeach
            ],
            backgroundColor: [
                @foreach ($top_ten_meds as $medicine)
                    @if($medicine->qty>0)
                    "RGBA({{rand(22,210)}},{{rand(54,255)}},{{rand(0,200)}},1)",
                    @endif
                @endforeach
			]
        },

    ],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        
    
    @foreach ($top_ten_meds as $medicine)
        @if($medicine->qty>0)
            '{{$medicine->name_sinhala}}',
        @endif
    @endforeach
        
    ],
    
};


var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
                    display: true,
                    position:'bottom',
                    fontSize:16,
					text: 'Mostly Issued Medicines'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
});



var ctx = document.getElementById("medicineDougnetMonth").getContext("2d");

medicineDougnetMonth = {
    datasets: 
    [
        {
            data: 
            [
            @foreach ($this_month_meds as $medicine)
                @if($medicine->issues>0)
                {{$medicine->issues}},
                @endif
            @endforeach
            ],
            backgroundColor: [
                @foreach ($this_month_meds as $medicine)
                    @if($medicine->issues>0)
                    "RGBA({{rand(3,180)}},{{rand(0,90)}},{{rand(1,255)}},1)",
                    @endif
                @endforeach
			]
        },

    ],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        
    
    @foreach ($this_month_meds as $medicine)
        @if($medicine->issues>0)
            '{{$medicine->name_sinhala}}',
        @endif
    @endforeach
        
    ],
    
};


var medicineDougnetMonthGraph = new Chart(ctx, {
    type: 'doughnut',
    data: medicineDougnetMonth,
    options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
                    display: true,
                    position:'bottom',
                    fontSize:16,
					text: 'Mostly Issued Medicines'
				},
				animation: {
					animateScale: true,
					animateRotate: true
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