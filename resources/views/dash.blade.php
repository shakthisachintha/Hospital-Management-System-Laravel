@extends('template.main')

@section('title', $title)


@section('content_title',__("Dashboard"))
@section('content_description',__("Operate All The Things Here"))
@section('breadcrumbs')
<ol class="breadcrumb">
    <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>

@endsection

@section('main_content')

<div class="row">
    <div class="m-0 col-md-12">
        <div class="pl-0 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-user-md"></i></span>
                <div class="info-box-content">
                    <h3><b><span class="info-box-text">{{__('Doctors')}}</span></b></h3>
                    <span class="info-box-number">{{$doctorcnt}}</span>
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
                    <h3><b><span class="info-box-text">{{__('General Staff')}}</span></b></h3>
                    <span class="info-box-number">{{$generalcnt}}</span>
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
                    <h3><b><span class="info-box-text">{{__('Pharmacists')}}</span></b></h3>
                    <span class="info-box-number">{{$pharmacistcnt}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 pr-0 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-user-injured"></i></span>

                <div class="info-box-content">
                    <h3><b><span class="info-box-text">{{__('In Patients')}}</span></b></h3>
                    <span class="info-box-number">{{$inpatientcnt}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Quick Reports')}}</h3>
            </div>
            <div class="box-body list-group">
                <a href="{{route('mon_stat_report')}}" class="list-group-item list-group-item-action btn btn-danger">
                   {{ __('Monthly Statistic Report')}}
                </a>
                <a href="{{route('stats')}}" class="list-group-item mt-1 list-group-item-action btn btn-warning">
                    {{__('Statistics')}}
                </a>
                <a href="{{route('attendance_report')}}" class="list-group-item mt-1 list-group-item-action btn btn-success">
                    {{__('Attendance Report')}}
                </a>
                <a href="{{route('clinic_reports')}}" class="list-group-item mt-1 list-group-item-action btn btn-info">
                    {{__('Clinic Report')}}
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-default col-md-12">

            <div class="box-header with-border">
                <h3 class="box-title">{{__('Quick Links')}}</h3>
            </div>

            <div class="box-body">

                <div class="col-sm-2">
                    <a href="{{route('patient')}}" class="btn btn-app">
                        <i class="ion ion-person-add"></i> {{__('Register out-patient')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('searchPatient')}}" class="btn btn-app">
                        <i class="ion ion-stats-bars"></i>{{__('Search Patient')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('register_in_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-procedures"></i> {{__('Register in-Patient')}}
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('check_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-heartbeat"></i> {{__('Check Patient')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('create_channel_view')}}" class="btn btn-app">
                        <i class="fa fa-plus-square"></i> {{__('Create Appointment')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('issueMedicineView')}}" class="btn btn-app">
                        <i class="fa fa-medkit"></i> {{__('Issue Medicine')}}
                    </a>
                </div>

            </div>
            <div class="box-body">

                <div class="col-sm-2">
                    <a href="{{route('myattend')}}" class="btn btn-app">
                        <i class="fa fa-user"></i> {{__('My Attendance')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('newuser')}}" class="btn btn-app">
                        <i class="fa fa-user-plus"></i> {{__('Register User')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('regfinger')}}" class="btn btn-app">
                        <i class="fa fa-fingerprint"></i> {{__('Register Fingerprints')}}
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('resetuser')}}" class="btn btn-app">
                        <i class="fa fa-user-edit"></i> {{__('Reset Users')}}
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('profile')}}" class="btn btn-app">
                        <i class="fa fa-home"></i> {{__('User Profile')}}
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('createnoticeview')}}" class="btn btn-app">
                        <i class="fa fa-commenting"></i> {{__('Notices')}}
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Noticeboard')}}</h3>
            </div>
            <div class="box-body">

                @foreach ($notices as $note)
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <b>
                                <h4 class="mb-1">{{$note->subject}}</h4>
                            </b>
                            <small>{{$note->time}}</small>
                        </div>
                        <p class="mb-1">{{$note->description}}</p>
                        <small>By {{$note->name}} ({{$note->user_type}})</small>
                    </a>
                </div>
                @endforeach
                @if (count($notices)==0)
                <h3 class="text-center"><i class="fas fa-angle-double-left"></i>..........Empty..........<i
                        class="fas fa-angle-double-right"></i></h3>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">

        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </div>
</div>
@endsection
@section('optional_scripts')
<script>
    // The Calender
    $('#calendar').datepicker();
</script>
@endsection
