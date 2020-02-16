@extends('template.main')

@section('title', $title)


@section('content_title',"Dashboard")
@section('content_description',"Operate All The Things Here")
@section('breadcrumbs')
<ol class="breadcrumb">
    <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>

@endsection

@section('main_content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-user-md"></i></span>
                <div class="info-box-content">
                    <h3><b><span class="info-box-text">Doctors</span></b></h3>
                    <span class="info-box-number">90</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-id-card-alt"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text">Nurses</span></b></h3>
                    <span class="info-box-number">10</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-briefcase-medical"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text">Pharmasists</span></b></h3>
                    <span class="info-box-number">2</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-user-injured"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text">In Patients</span></b></h3>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-default col-md-12">

            <div class="box-header with-border">
                <h3 class="box-title">Short-cuts</h3>
            </div>

            <div class="box-body">

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>
                </div>

            </div>
            <div class="box-body">

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>
                </div>

            </div>
            <div class="box-body">

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Noticeboard</h3>
                </div>
                <div class="box-body">
                    {{--  @if ($notices)  --}}
                    @foreach ($notices as $notice)
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <b><h4 class="mb-1">{{$notice->subject}}</h4></b>
                                <small>{{$notice->time}}</small>
                            </div>
                            <p class="mb-1">{{$notice->description}}</p>
                            <small>By {{$notice->name}} ({{$notice->user_type}})</small>
                        </a>
                    </div>
                    @endforeach
                    {{--  @else
                    <h3>No Notices !!!</h3>
                    @endif  --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reports</h3>
                </div>
                <div class="box-body list-group">
                    <a href="{{route('clinic_reports')}}" class="list-group-item list-group-item-action btn btn-info">
                        Clinic Reports
                    </a>
                    <a href="{{route('mon_stat_report')}}"
                        class="list-group-item list-group-item-action btn btn-danger">
                        Monthly Statistic Report
                    </a>
                    <a href="{{route('out_p_report')}}" class="list-group-item list-group-item-action btn btn-warning">
                        Out-Patient Report
                    </a>
                    <a href="{{route('ward_report')}}" class="list-group-item list-group-item-action btn btn-success">
                        Ward Reports
                    </a>
                    <a href="{{route('attendance_report')}}"
                        class="list-group-item list-group-item-action btn bg-purple">
                        Attendance Report
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection
