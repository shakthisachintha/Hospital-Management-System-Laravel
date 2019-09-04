@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
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

    {{-- Users Operations --}}

    <li class="active treeview">
        <a href="#"><i class="fas fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('newuser')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-user-plus" aria-hidden="true"></i>New User</a></li>
            <li class="active"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-fingerprint" aria-hidden="true"></i>Register Fingerprint</a></li>
            <li><a href="{{route('resetuser')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}
<li><a href="{{route('profile')}}"><i class="fa fa-id-card" aria-hidden="true"></i> <span>Profile</span></a></li>
</ul>

@endsection
@section('content_title',$title)
@section('content_description',"Register New Fingerprint For A New User")

@section('breadcrumbs')

<ol class="breadcrumb">
<li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:10vh;padding:3%" class="row">
    <div class="col-md-2"></div>
    <div class="mt-5 col-md-8 mx-auto">
            <div class="mt-5 box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Register Fingerprint</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="userid" class="col-sm-2 control-label">User ID</label>
            
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="userid" placeholder="User ID">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="fingerid" class="col-sm-2 control-label">Fingerprint ID</label>
            
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="fingerid" placeholder="Fingerprint ID">
                          </div>
                        </div>
                        
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Register</button>
                      </div>
                      <!-- /.box-footer -->
                    </form>
                  </div>
    </div>
    <div class="col-md-2"></div>
</div>



@endsection
