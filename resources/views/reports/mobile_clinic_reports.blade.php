@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('dash')}}">
        <i class="fas fa-tachometer-alt"></i>
        <span> Dashboard</span></a>
    </li>
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
            <li><a href="{{route('register_in_patient_view')}}"><i class="fas fa-user-plus" area-hidden="true"></i><span> Register In Patient</span></a></li>
        </ul>
    </li>
    {{--create channel--}}
    <li>
        <a href="{{route('create_channel_view')}}">
        <i class="fas fa-folder-plus"></i>
        <span> Create Appoinment</span>
        </a>
    </li>
    {{--check patient--}}
    <li><a href="{{route('check_patient_view')}}"><i class="fas fa-procedures"></i><span> Check Patient</span></a></li>

    {{--issue medicine--}}
    <li><a href="{{route('issueMedicineView')}}"><i class="fa fa-medkit"></i><span>Issue Medicine</span></a></li>

    <li class="treeview">
        <a href="#"><i class="fas fa-calendar-check"></i></i><span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('myattend')}}"><i class="fas fa-calendar-day" aria-hidden="true"></i>My Attendance</a></li>
            <li><a href="{{route('attendmore')}}"><i class="fas fa-plus-square" aria-hidden="true"></i>More</a></li>
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
            <li><a href="{{route('newuser')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>New User</a></li>
            <li><a href="{{route('regfinger')}}"><i class="fa fa-fingerprint" aria-hidden="true"></i>Register Fingerprint</a></li>
            <li><a href="{{route('resetuser')}}"><i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}

    <li><a href="{{route('profile')}}"><i class="fas fa-user"></i><span> Profile</span></a></li>


    {{--add notices--}}
    <li>
        <a href="{{route('createnoticeview')}}">
            <i class="fas fa-envelope-open-text"></i>
        <span> Notices</span>
        </a>
    </li>

    {{--report generation--}}
    <li class="active treeview">
        <a href="#">
            <i class="fas fa-sticky-note"></i>
            <span> Report Generation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('clinic_reports')}}"><i class="fa fa-stethoscope" aria-hidden="true"></i> Clinic Report</a></li>
            <li class="active"><a href="{{route('mob_clinic_report')}}"><i class="fa fa-ambulance" aria-hidden="true"></i> Mobile Clinic Report</a></li>
            <li><a href="{{route('mon_stat_report')}}"><i class="fa fa-sticky-note" aria-hidden="true"></i> Monthly Statistic Report</a></li>
            <li><a href="{{route('out_p_report')}}"><i class="fa fa-user-edit" aria-hidden="true"></i> Out-Patient Report</a></li>
            <li><a href="{{route('attendance_report')}}"><i class="fa fa-calendar-alt" aria-hidden="true"></i> Attendance Report</a></li>
        </ul>
    </li>

    <li>
        <a href="https://adminlte.io/themes/AdminLTE/index2.html">
        <i class="fas fa-folder-plus"></i>
        <span> Template</span>
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
<h3>hiiiiiiiiiiiiiiiiiiiiiiiii</h3>

    </div>
    <!-- /.row -->

</section>

@endsection
