@extends('template.main')

@section('title', $title)

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
                            <textarea class="form-control" name="message" rows="5" placeholder="Enter Message"
                                required></textarea>
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
                                        <input type="checkbox" name="receiverlist[]" value="general"> Staff
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="receiverlist[]" value="pharmacist"> Pharmasist
                                    </label>
                                </div>
                                {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="receiverlist[]" value="patient"> Patient
                                    </label>
                                </div> --}}
                            </div>

                            <div class="col-md-1">
                            </div>
                        </div>

                        <br>

                        <div class="form-group col-md-2 pull-right">
                            <input type="submit" class="btn btn-danger btn-lg" name="send" value="Send">
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
