@extends('template.main')

@section('title', $title)

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
        <a href="#"><i class="fas fa-users-cog"></i><span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-user-plus"></i>New User</a></li>
            <li><a href="{{route('regfinger')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-fingerprint" aria-hidden="true"></i>Register Fingerprint</a></li>
            <li><a href="{{route('resetuser')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}
<li><a href="{{route('profile')}}"><i class="fa fa-id-card" aria-hidden="true"></i> <span>Profile</span></a></li>
</ul>

@endsection
@section('content_title',"Register New User")
@section('content_description',"Add a New User To The System")
@section('breadcrumbs')

<ol class="breadcrumb">
<li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

                @if ($message = Session::get('success'))
                <div style="margin-top:3.5vh !important" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4>
                        New User-{{$message}} Added To The System.
                      </div>
                @endif

                <div style="padding:10px;margin-top:4.5vh !important" class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">User Registration Form</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('register') }}">
                                @csrf
                          <div class="box-body">
                            <div class="form-group">
                              <label for="name">Name Of The User</label>
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                              @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                            </div>
                            <div class="form-group">
                              <label for="email">Email Address</label>
                              <input required id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input required value="12345678" readonly id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                              <span class="text-primary" role="alert">
                                    <strong>Default Password 12345678</strong>
                                </span>
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                                @enderror
                            </div>

                            <div class="form-group">
                              <label for="password-confirm">Confirm Password</label>
                              <input required readonly id="password-confirm" type="password" class="form-control" name="password_confirmation" value="12345678" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label>Contact No : </label>
                                <input required type="tel" class="form-control" name="contactno"  placeholder="Enter Your Contact No...">
                            </div>


                            <div class="form-group">
                                    <label for="user-type">{{ __('User Type') }}</label>
                                        <select required id="user-type" type="select" class="form-control" name="user_type" required>
                                        <option value="admin">Administrator</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="pharmacist">Pharmacist</option>
                                        <option selected value="general">General Staff</option>
                                        </select>
                            </div>

                          <!-- /.box-body -->

                          <div class="">



            <button type="submit" class="pull-right btn btn-primary">Register</button>

</div>

                          </div>

                        </form>
                      </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


@endsection
