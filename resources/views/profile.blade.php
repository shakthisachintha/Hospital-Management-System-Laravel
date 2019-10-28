@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a></li>
{{--patient--}}
    <li class="treeview">
        <a href="#"><i class="fas fa-user-injured"></i><span> Patient</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('patient')}}"></i><i class="fas fa-user-plus" aria-hidden="true"></i> Register New</a></li>
            <li><a href="#"></i><i class="fas fa-id-card" aria-hidden="true"></i> Search Patient</a></li>
{{--register in patient--}}
            <li><a href="{{route('register_in_patient_view')}}"><i class="fas fa-user-plus" are-hidden="true"></i><span> Register In Patient</span></a></li>

        </ul>
    </li>
{{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Appoinment</span></a></li>
{{--check patient--}}
    <li><a href="{{route('check_patient_view')}}"><i class="fas fa-procedures"></i><span> Check Patient</span></a></li>

{{--register in patient--}}
    <li><a href="{{route('register_in_patient_view')}}"><i class="fas fa-user-plus"></i><span> Register In Patient</span></a></li>

    <li class="treeview">
        <a href="#"><i class="fas fa-calendar-check"></i></i><span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('myattend')}}">      <i class="fas fa-calendar-day" aria-hidden="true"></i> My Attendance</a></li>
            <li><a href="{{route('attendmore')}}"><i class="fas fa-plus-square" aria-hidden="true"></i> More</a></li>
        </ul>
    </li>

     {{-- Users Operations --}}

     <li class="treeview">
        <a href="#"><i class="fas fa-users-cog"></i><span> Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('newuser')}}">  <i class="fa fa-user-plus" aria-hidden="true"></i>New User</a></li>
            <li><a href="{{route('regfinger')}}"><i class="fa fa-fingerprint" aria-hidden="true"></i>Register Fingerprint</a></li>
            <li><a href="{{route('resetuser')}}"><i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}

    <li><a href="{{route('profile')}}"><i class="fas fa-user"></i><span> Profile</span></a></li>
</ul>

@endsection

@section('content_title',"User Profile")
@section('content_description',"Personalize Your Account")
@section('breadcrumbs')

<ol class="breadcrumb">
<li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
<?php $user = Auth::user();
$name = $user->name;
$user_type =$user->user_type;
$image_path =$user->img_path;
$outlet = 'Rural Ayruvedic Hospital Kesbawa'?>

<section class="content">

    <div class="row">

        <div class="col-md-9">
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Activity</a></li>
                <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Timeline</a></li>
                <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="activity">
                    <h3>empty for now</h3>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                        <h3>empty for now</h3>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane active" id="settings">

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <a data-toggle="collapse" href="#collapseOne" class="collapsed" aria-expanded="false">
                            <h3 class="box-title"><i class="fa fa-cogs"></i>  General</h3>
                            </a>


                        </div>
                        <div  id="collapseOne" class="panel-collapse collapse" aria-expanded="false">
                            <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-signature"></i> Change Name</a></li>
                            <li><a href="#"><i class="fa fa-address-book"></i> Change Contact Number</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> Change email</a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <a data-toggle="collapse" href="#collapseTwo" class="@if (session('error')) collapse in @else collapsed @endif" aria-expanded="@if (session('error')) true @else false @endif">
                                <h3 class="box-title"><i class="fa fa-user-shield"></i> Security and Login</h3>
                            </a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse @if (session('error')) collapse in @else collapsed @endif" aria-expanded="@if (session('error')) true @else false @endif">
                            <ul class="nav nav-pills nav-stacked">
                            <li><a data-toggle="collapse" href="#changeprofilepic" class="collapsed" aria-expanded="false"><i class="fa fa-camera"></i> Change Profile Picture</a></li>

                            <div id="changeprofilepic" class="panel-collapse collapse" aria-expanded="false">

                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <img src="images/{{ Session::get('image') }}">
                                @endif

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- form start -->
                                <form action="{{ route('change_propic') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <p class="help-block">select your new profile picture here.</p>
                                            <input type="file" id="exampleInputFile" name="propic" class="form-control">
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>

                            <li><a data-toggle="collapse" href="#changepw" class="collapse" aria-expanded="false"><i class="fa fa-unlock"></i> Change Password</a></li>

                            <div id="changepw" class="panel-collapse @if (session('error')) collapse in @else collapse @endif" aria-expanded="false">


                                @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif


                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- form start -->
                                <form class="form-horizontal" method="post" action="{{ route('change_password') }}">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Current Password</label>

                                            <div class="col-sm-10">
                                            <input type="password" name="currentpassword" class="form-control" id="inputEmail3" placeholder="Current Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>

                                            <div class="col-sm-10">
                                            <input type="password" name="newpassword" class="form-control" id="inputPassword3" placeholder="Enter New assword">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword4" class="col-sm-2 control-label">New Password Again</label>

                                            <div class="col-sm-10">
                                            <input type="password" name="newpasswordagain" class="form-control" id="inputPassword4" placeholder="Enter New Password Again">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-info pull-right">Update</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>

                            <li><a href="#"><i class="fa fa-fingerprint"></i> Change FingerPrint</a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>


                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-danger">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$image_path}}" alt="User profile picture">

                    <h3 class="profile-username text-center">Nina Mcintire</h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                    </ul>

                    <a href="#" class="btn btn-warning btn-block"><b>Follow</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-success">

                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                    <p class="text-muted">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">Malibu, California</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                    <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>


@endsection
