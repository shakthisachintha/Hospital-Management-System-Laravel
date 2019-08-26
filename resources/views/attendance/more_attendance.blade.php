@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
<li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fas fa-user-injured"></i> <span>Patient</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-user-plus" aria-hidden="true"></i>Register New</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-id-card" aria-hidden="true"></i>Search Patient</a></li>
        </ul>
    </li>
    <li class="treeview active">
        <a href="#"><i class="far fa-calendar-check"></i></i> <span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('myattend')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-calendar-day" aria-hidden="true"></i>My Attendance</a></li>
            <li class="active"><a><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-plus-square" aria-hidden="true"></i>More</a></li>
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
    