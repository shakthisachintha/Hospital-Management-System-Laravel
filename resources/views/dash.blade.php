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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Doctors</span>
                    <span class="info-box-number">90</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Nurses</span>
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
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pharmasists</span>
                    <span class="info-box-number">2</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">In Patients</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>



    <div class="col-xs-12">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Patients</h3>
            </div>
            <div class="box-body">
                <div class="col-lg-3 col-xs-6">
                    {{--       <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                <h3>#</h3>

                                <p>Register New</p>
                                </div>
                            <div class="icon">
                            <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('patient')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>--}}
                    <a href="{{route('patient')}}" class="btn btn-app">
                        {{-- <span class="badge bg-purple">891</span> --}}
                        <i class="ion ion-person-add"></i> Patients
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    {{-- <div class="small-box bg-green">
                      <div class="inner">
                        <h3>#</h3>

                        <p>Search Patient</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="{{route('searchPatient')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div> --}}
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        {{-- <span class="badge bg-purple">891</span> --}}
                        <i class="ion ion-stats-bars"></i> Search Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    {{--   <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>#</h3>

                          <p>Register in-Patient</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <a href="{{route('register_in_patient_view')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div> --}}
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        {{-- <span class="badge bg-purple">891</span> --}}
                        <i class="fa fa-procedures"></i> Register in-Patient
                    </a>

                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Reports</h3>
                </div>
                <div class="box-body">
                    <a href="{{route('clinic_reports')}}" class="btn btn-info">
                        Clinic Reports
                    </a>
                    <a href="{{route('mob_clinic_report')}}" class="btn bg-maroon">
                        Mobile Clinic Report
                    </a>
                    <a href="{{route('mon_stat_report')}}" class="btn btn-danger">
                        Monthly Statistic Report
                    </a>
                    <a href="{{route('out_p_report')}}" class="btn btn-warning">
                        Out-Patient Report
                    </a>
                    <a href="{{route('ward_report')}}" class="btn btn-success">
                        Ward Reports
                    </a>
                    <a href="{{route('attendance_report')}}" class="btn bg-purple">
                        Attendance Report
                    </a>
                </div>
            </div>
        </div>



@endsection
