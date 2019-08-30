@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
{{--patient--}}
    <li class="treeview">
        <a href="#"><i class="fas fa-user"></i> <span>Patient</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('patient')}}"></i><i class="fa fa-user-plus" aria-hidden="true"></i>Register New</a></li>
            <li><a href="#"></i><i class="fa fa-id-card" aria-hidden="true"></i>Search Patient</a></li>
        </ul>
    </li>
{{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fa fa-user"></i> <span>Create Channel</span></a></li>
{{--check patient--}}
    <li><a href="{{route('check_patient_view')}}"><i class="fa fa-procedures"></i> <span>Check Patient</span></a></li>
    <li class="treeview">
        <a href="#"><i class="far fa-calendar-check"></i></i> <span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('myattend')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-calendar-day" aria-hidden="true"></i>My Attendance</a></li>
            <li><a href="{{route('attendmore')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-plus-square" aria-hidden="true"></i>More</a></li>
        </ul>
    </li>
<li><a href="{{route('profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
</ul>

@endsection
@section('content_title',"My Attendance")
@section('content_description',"My Attendance And Holidays Taken")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  patient registration  --}}
    @if (session()->has('regpsuccess'))
        <div class="row">
            <div class="alert alert-success" role="alert">
                {{session()->get('regpsuccess')}}
            </div>
        </div>
    @endif
    <div class="row">
        <!-- right column -->
        <div class="col-md-10">
            <!-- Horizontal Form -->
            <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{ route('patient_register') }}" class="form-horizontal">
                {{csrf_field()}}
                <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_pname" placeholder="Enter Patient Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_paddress" placeholder="Enter Patient Address ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Occupation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_poccupation" placeholder="Enter Patient Occupation ">
                    </div>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sex</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="reg_psex">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-1 control-label">Age</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="reg_page" placeholder="Enter Age">
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" value="Register">
                    <input type="button" class="btn btn-default" value="Cancel">
                </div>
                <!-- /.box-footer -->
            </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
