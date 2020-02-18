@extends('template.main')

@section('title', $title)

@section('content_title',__("Register New User"))
@section('content_description',__("Add a New User To The System"))
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
                    <h3 class="box-title">{{__('User Registration Form')}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">{{__('Name Of The User')}} <span class="text-red">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email Address')}} <span class="text-red">*</span></label>
                            <input required id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password')}} <span class="text-red">*</span></label>
                            <input required value="12345678" readonly id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            <span class="text-primary" role="alert">
                                <strong>{{__('Default Password 12345678')}}</strong>
                            </span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{__('Confirm Password')}} <span class="text-red">*</span></label>
                            <input required readonly id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" value="12345678" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label>{{__('Contact No :')}} </label>
                            <input required type="text" class="form-control" name="contactno"
                                placeholder="Enter Your Contact No...">
                        </div>


                        <div class="form-group">
                            <label for="user-type">{{ __('User Type') }} <span class="text-red">*</span></label>
                            <select required id="user-type" type="select" class="form-control" name="user_type"
                                required>
                                <option value="admin">Administrator</option>
                                <option value="doctor">Doctor</option>
                                <option value="pharmacist">Pharmacist</option>
                                <option selected value="general">General Staff</option>
                            </select>
                        </div>

                        <!-- /.box-body -->

                        <div>

                            <button type="submit" class="pull-right btn btn-primary">{{__('Register')}}</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


@endsection