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
    <div class="m-0 col-md-12">
        <div class="pl-0 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-user-md"></i></span>
                <div class="info-box-content">
                    <h3><b><span class="info-box-text">Doctors</span></b></h3>
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
                    <h3><b><span class="info-box-text">General Staff</span></b></h3>
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
                    <h3><b><span class="info-box-text">Pharmacists</span></b></h3>
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
                    <h3><b><span class="info-box-text">In Patients</span></b></h3>
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
                    {{__('Monthly Statistic Report')}}
                </a>
                <a href="{{route('stats')}}" class="list-group-item mt-4 list-group-item-action btn btn-warning">
                    {{__('Statistics')}}
                </a>
                <a href="{{route('attendance_report')}}" class="list-group-item mt-4 list-group-item-action btn btn-success">
                    {{__('Attendance Report')}}
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
                        <i class="ion ion-person-add"></i> Register out-patient
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
                    <a href="{{route('check_patient_view')}}" class="btn btn-app">
                        <i class="fa fa-heartbeat"></i> Check Patient
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('create_channel_view')}}" class="btn btn-app">
                        <i class="fa fa-plus-square"></i> Create Appointment
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('issueMedicineView')}}" class="btn btn-app">
                        <i class="fa fa-medkit"></i> Issue Medicine
                    </a>
                </div>

            </div>
            <div class="box-body">

                <div class="col-sm-2">
                    <a href="{{route('myattend')}}" class="btn btn-app">
                        <i class="fa fa-user"></i> My Attendance
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('newuser')}}" class="btn btn-app">
                        <i class="fa fa-user-plus"></i> Register User
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('regfinger')}}" class="btn btn-app">
                        <i class="fa fa-fingerprint"></i> Register Fingerprint
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('resetuser')}}" class="btn btn-app">
                        <i class="fa fa-user-edit"></i> Reset User
                    </a>
                </div>


                <!-- ./col -->
                <div class="col-sm-2">
                    <a href="{{route('profile')}}" class="btn btn-app">
                        <i class="fa fa-home"></i> User Profile
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="{{route('createnoticeview')}}" class="btn btn-app">
                        <i class="fa fa-commenting"></i> Notices
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
                <h3 class="box-title">Noticeboard</h3>
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
        <div class="box box-solid bg-black-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn bg-purple btn-sm dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn bg-purple btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-purple btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%">
                    <div class="datepicker datepicker-inline">
                        <div class="datepicker-days" style="">
                            <table class="table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="7" class="datepicker-title" style="display: none;"></th>
                                    </tr>
                                    <tr>
                                        <th class="prev">«</th>
                                        <th colspan="5" class="datepicker-switch">September 2020</th>
                                        <th class="next">»</th>
                                    </tr>
                                    <tr>
                                        <th class="dow">Su</th>
                                        <th class="dow">Mo</th>
                                        <th class="dow">Tu</th>
                                        <th class="dow">We</th>
                                        <th class="dow">Th</th>
                                        <th class="dow">Fr</th>
                                        <th class="dow">Sa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="old day" data-date="1598745600000">30</td>
                                        <td class="old day" data-date="1598832000000">31</td>
                                        <td class="day" data-date="1598918400000">1</td>
                                        <td class="day" data-date="1599004800000">2</td>
                                        <td class="day" data-date="1599091200000">3</td>
                                        <td class="day" data-date="1599177600000">4</td>
                                        <td class="day" data-date="1599264000000">5</td>
                                    </tr>
                                    <tr>
                                        <td class="day" data-date="1599350400000">6</td>
                                        <td class="day" data-date="1599436800000">7</td>
                                        <td class="day" data-date="1599523200000">8</td>
                                        <td class="day" data-date="1599609600000">9</td>
                                        <td class="day" data-date="1599696000000">10</td>
                                        <td class="day" data-date="1599782400000">11</td>
                                        <td class="day" data-date="1599868800000">12</td>
                                    </tr>
                                    <tr>
                                        <td class="day" data-date="1599955200000">13</td>
                                        <td class="day" data-date="1600041600000">14</td>
                                        <td class="day" data-date="1600128000000">15</td>
                                        <td class="day" data-date="1600214400000">16</td>
                                        <td class="day" data-date="1600300800000">17</td>
                                        <td class="day" data-date="1600387200000">18</td>
                                        <td class="day" data-date="1600473600000">19</td>
                                    </tr>
                                    <tr>
                                        <td class="day" data-date="1600560000000">20</td>
                                        <td class="day" data-date="1600646400000">21</td>
                                        <td class="day" data-date="1600732800000">22</td>
                                        <td class="day" data-date="1600819200000">23</td>
                                        <td class="day" data-date="1600905600000">24</td>
                                        <td class="day" data-date="1600992000000">25</td>
                                        <td class="day" data-date="1601078400000">26</td>
                                    </tr>
                                    <tr>
                                        <td class="day" data-date="1601164800000">27</td>
                                        <td class="day" data-date="1601251200000">28</td>
                                        <td class="day" data-date="1601337600000">29</td>
                                        <td class="day" data-date="1601424000000">30</td>
                                        <td class="new day" data-date="1601510400000">1</td>
                                        <td class="new day" data-date="1601596800000">2</td>
                                        <td class="new day" data-date="1601683200000">3</td>
                                    </tr>
                                    <tr>
                                        <td class="new day" data-date="1601769600000">4</td>
                                        <td class="new day" data-date="1601856000000">5</td>
                                        <td class="new day" data-date="1601942400000">6</td>
                                        <td class="new day" data-date="1602028800000">7</td>
                                        <td class="new day" data-date="1602115200000">8</td>
                                        <td class="new day" data-date="1602201600000">9</td>
                                        <td class="new day" data-date="1602288000000">10</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="today" style="display: none;">Today</th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="clear" style="display: none;">Clear</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="datepicker-months" style="display: none;">
                            <table class="table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="7" class="datepicker-title" style="display: none;"></th>
                                    </tr>
                                    <tr>
                                        <th class="prev">«</th>
                                        <th colspan="5" class="datepicker-switch">2020</th>
                                        <th class="next">»</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span
                                                class="month">Mar</span><span class="month">Apr</span><span
                                                class="month">May</span><span class="month">Jun</span><span
                                                class="month">Jul</span><span class="month">Aug</span><span
                                                class="month focused">Sep</span><span class="month">Oct</span><span
                                                class="month">Nov</span><span class="month">Dec</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="today" style="display: none;">Today</th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="clear" style="display: none;">Clear</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="datepicker-years" style="display: none;">
                            <table class="table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="7" class="datepicker-title" style="display: none;"></th>
                                    </tr>
                                    <tr>
                                        <th class="prev">«</th>
                                        <th colspan="5" class="datepicker-switch">2020-2029</th>
                                        <th class="next">»</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7"><span class="year old">2019</span><span
                                                class="year focused">2020</span><span class="year">2021</span><span
                                                class="year">2022</span><span class="year">2023</span><span
                                                class="year">2024</span><span class="year">2025</span><span
                                                class="year">2026</span><span class="year">2027</span><span
                                                class="year">2028</span><span class="year">2029</span><span
                                                class="year new">2030</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="today" style="display: none;">Today</th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="clear" style="display: none;">Clear</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="datepicker-decades" style="display: none;">
                            <table class="table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="7" class="datepicker-title" style="display: none;"></th>
                                    </tr>
                                    <tr>
                                        <th class="prev">«</th>
                                        <th colspan="5" class="datepicker-switch">2000-2090</th>
                                        <th class="next">»</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7"><span class="decade old">1990</span><span
                                                class="decade">2000</span><span class="decade">2010</span><span
                                                class="decade focused">2020</span><span class="decade">2030</span><span
                                                class="decade">2040</span><span class="decade">2050</span><span
                                                class="decade">2060</span><span class="decade">2070</span><span
                                                class="decade">2080</span><span class="decade">2090</span><span
                                                class="decade new">2100</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="today" style="display: none;">Today</th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="clear" style="display: none;">Clear</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="datepicker-centuries" style="display: none;">
                            <table class="table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="7" class="datepicker-title" style="display: none;"></th>
                                    </tr>
                                    <tr>
                                        <th class="prev">«</th>
                                        <th colspan="5" class="datepicker-switch">2000-2900</th>
                                        <th class="next">»</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7"><span class="century old">1900</span><span
                                                class="century focused">2000</span><span class="century">2100</span><span
                                                class="century">2200</span><span class="century">2300</span><span
                                                class="century">2400</span><span class="century">2500</span><span
                                                class="century">2600</span><span class="century">2700</span><span
                                                class="century">2800</span><span class="century">2900</span><span
                                                class="century new">3000</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="today" style="display: none;">Today</th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="clear" style="display: none;">Clear</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

        </div>

    </div>
</div>

@endsection
