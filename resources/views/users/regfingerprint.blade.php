@extends('template.main')

@section('title', $title)

<<<<<<< HEAD
@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
{{--patient--}}
    <li class="treeview">
        <a href="#"><i class="fas fa-user-injured"></i><span>Patient</span>
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
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Channel</span></a></li>
{{--check patient--}}
    <li><a href="{{route('check_patient_view')}}"><i class="fa fa-procedures"></i> <span>Check Patient</span></a></li>

{{--issue medicine--}}
    <li><a href="{{route('issueMedicineView')}}"><i class="fa fa-medkit"></i><span>Issue Medicine</span></a></li>

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
        <a href="#"><i class="fas fa-users-cog"></i> <span>Users</span>
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
=======
>>>>>>> 4601dd9d491c33f27d0d9c1f253482f2548d7f5e
@section('content_title',$title)
@section('content_description',"Register New Fingerprint For A New User")

@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:1vh;padding:3%" class="row">
    <div class="col-md-2"></div>
    <div class="mt-5 col-md-8 mx-auto">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session()->get('success')}}
        </div>
        @endif
        @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>

            {{session()->get('fail')}}
        </div>
        @endif

        <div class="mt-5 box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Register Fingerprint</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{route('user.regfinger')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="userid" class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="number" name="userid"
                                class="form-control @error('userid') border border-danger @enderror" id="userid"
                                value="{{ old('userid') }}" placeholder="User ID">
                            @error('userid')
                            <span class="text-danger text-capitalize invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fingerid" class="col-sm-2 control-label">Fingerprint ID</label>

                        <div class="col-sm-10">
                            <input type="number" name="fingerid"
                                class="form-control @error('fingerid') border border-danger @enderror"
                                value="{{ old('fingerid') }}" id="fingerid" placeholder="Fingerprint ID">
                            @error('fingerid')
                            <span class="text-danger text-capitalize invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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