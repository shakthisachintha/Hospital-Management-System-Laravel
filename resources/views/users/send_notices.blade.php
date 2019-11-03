@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li class=""><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a></li>
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

    {{--add notices--}}
    <li class="treeview active">
        <a href="{{route('createnoticeview')}}">
        <i class="fas fa-sticky-note"></i>
        <span> Notices</span>
        </a>
    </li>
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
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Send Notices</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    {{--  display validattion errors  --}}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form role="form" method="post" action="{{ route('sendnotice') }}">

                        {{csrf_field()}}

                        <!-- textarea -->
                        <div class="form-group">
                            <label>Enter your Message</label>
                            <textarea class="form-control" name="message" rows="5" placeholder="Enter Message" required></textarea>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-2">
                                <label>Select Method :</label>
                            </div>

                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="emails" value="email"> Emails
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="sms" value="sms"> SMS
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                    <label>Select Receivers :</label>
                            </div>

                            <div class="col-md-3">
                                <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="receiverlist[]" value="admin"> Admin
                                        </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="receiverlist[]" value="doctor"> Doctor
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="receiverlist[]" value="staff"> Staff
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="receiverlist[]" value="pharmasist"> Pharmasist
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="receiverlist[]" value="patient"> Patient
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-1">
                            </div>
                        </div>

                        <br>

                        <div class="form-group col-md-2 pull-right">
                            <input type="submit" class="btn btn-danger btn-lg" name="send" value="Send" >
                        </div>

                    </form>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </div>


</section>


@endsection
