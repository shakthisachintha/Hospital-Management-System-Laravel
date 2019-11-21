@extends('template.main')

@section('title', $title)

<<<<<<< HEAD
@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a></li>
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
        </ul>
    </li>
{{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Channel</span></a></li>
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
        <li><a href="{{route('myattend')}}">      <i class="fas fa-calendar-day" aria-hidden="true"></i> My Attendance</a></li>
            <li><a href="{{route('attendmore')}}"><i class="fas fa-plus-square" aria-hidden="true"></i> More</a></li>
        </ul>
    </li>

    {{-- Users Operations --}}

    <li class="active treeview">
        <a href="#"><i class="fas fa-users-cog"></i><span> Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('newuser')}}">  <i class="fa fa-user-plus" aria-hidden="true"></i>New User</a></li>
            <li><a href="{{route('regfinger')}}"><i class="fa fa-fingerprint" aria-hidden="true"></i>Register Fingerprint</a></li>
            <li class="active"><a href="#">      <i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}
<li><a href="{{route('profile')}}"><i class="fas fa-id-card" aria-hidden="true"></i><span> Profile</span></a></li>
</ul>

@endsection
=======
>>>>>>> 4601dd9d491c33f27d0d9c1f253482f2548d7f5e
@section('content_title',"My Attendance")
@section('content_description',"My Attendance And Holidays Taken")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
<script src="https://code.jscharting.com/latest/jscharting.js"></script>


@endsection