@extends('template.main')

@section('title', ucfirst($title))

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
$name = ucfirst($user->name);
$user_type =$user->user_type;
$image_path =$user->img_path;
$email = $user->email;
$tp = $user->contactnumber;
$id = $user->id;

$outlet = 'Rural Ayruvedic Hospital Kesbawa'?>

<section class="content">

    <div class="row">

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li
                        class="@if (!(session('success') || session('errors') ||session('errorpw') || session('successpw')||session('successcn')||session('successedit'))) active @endif">
                        <a href="#activity" data-toggle="tab"
                            aria-expanded="@if (session('success') || session('errors')||session('errorpw') || session('successpw')||session('successcn')||session('successedit')) false @else true @endif">Activity
                            Log</a>
                    </li>

                    <li
                        class="@if (session('success') || session('errors') ||session('errorpw') || session('successpw')||session('successcn')||session('successedit') ) active @endif">
                        <a href="#settings" data-toggle="tab"
                            aria-expanded="@if (session('success') || session('errors')||session('errorpw') || session('successpw')||session('successcn')||session('successedit')) true @else false @endif">Settings</a>
                    </li>

                </ul>

                <div class="tab-content">
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

                    <div class="tab-pane @if (!(session('success')||session('successmail') || session('errors') ||session('errorpw') || session('successpw')||session('successcn')||session('successedit'))) active @endif"
                        id="activity">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered table-striped dataTable"
                                                role="grid" aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Subject Id</th>
                                                        <th>Subject Type</th>
                                                        <th>Causer Type</th>

                                                        <th>Created At</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($activity as $app)
                                                    <tr>
                                                        <td>{{$app->description}}</td>
                                                        <td>{{$app->subject_id}}</td>
                                                        <td>{{explode('\\',$app->subject_type)[1]}}</td>
                                                        <td>{{explode('\\',$app->causer_type)[1]}}</td>
                                                        <td>{{$app->created_at}}</td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <th>Description</th>
                                                    <th>Subject Id</th>
                                                    <th>Subject Type</th>
                                                    <th>Causer Type</th>
                                                    <th>Created At</th>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane @if (session('success') ||session('successmail') || session('errors') ||session('errorpw') || session('successpw')||session('successcn')||session('successedit') ) active @endif"
                        id="settings">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <a data-toggle="collapse" href="#collapseOne" class=""
                                    aria-expanded="@if (session('successcn')||session('successmail')||session('successedit')) true @else false @endif">
                                    <h3 class="box-title"><i class="fa fa-cogs"></i> General</h3>
                                </a>
                            </div>

                            <div id="collapseOne"
                                class="panel-collapse @if (session('successcn')||session('successmail')||session('successedit') ) collapse in @else collapse @endif"
                                aria-expanded="@if (session('successpw')||session('successmail')) true @else false @endif">
                                <ul class="nav nav-pills nav-stacked">

                                    <li><a data-toggle="collapse" href="#editprofile" class="collapsed"
                                            aria-expanded="false"><i class="fa fa-signature"></i> Edit Profile</a></li>

                                    <div id="editprofile"
                                        class="panel-collapse @if (session('successedit')) collapse in @else collapse @endif"
                                        aria-expanded="@if (session('successedit')) true @else false @endif">

                                        @if ($message = Session::get('successedit'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif

                                        <form action="{{route('editprofile')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Full Name</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                    placeholder="enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Education</label>
                                                <input type="text" name="education" class="form-control" id=""
                                                    placeholder="enter details">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Location</label>
                                                <input type="text" name="location" class="form-control" id=""
                                                    placeholder="enter details">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Skills</label>
                                                <input type="text" name="skills" class="form-control" id=""
                                                    placeholder="enter details">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Special Notes</label>
                                                <input type="text" name="notes" class="form-control" id=""
                                                    placeholder="enter details">
                                            </div>

                                            <div class="box-footer">
                                                <button type="reset" class="btn btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-info pull-right">Update</button>
                                            </div>
                                            <!-- /.box-footer -->

                                        </form>

                                    </div>

                                    <li><a data-toggle="collapse" href="#changecontactno" class="collapsed"
                                            aria-expanded="false"><i class="fa fa-address-book"></i> Change Contact
                                            Number</a></li>

                                    <div id="changecontactno"
                                        class="panel-collapse @if (session('successcn')) collapse in @else collapse @endif"
                                        aria-expanded="@if (session('successcn')) true @else false @endif">

                                        @if ($message = Session::get('successcn'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif



                                        <form action="{{route('changecontactnumber')}}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Current
                                                    Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="{{$currentno}}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">New
                                                    Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="newcontactnumber" class="form-control"
                                                        placeholder="enter new number">
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="reset" class="btn btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-danger pull-right">Update</button>
                                            </div>
                                            <!-- /.box-footer -->
                                        </form>
                                    </div>

                                    <li><a data-toggle="collapse" href="#changeemail" class="collapsed"
                                            aria-expanded="false"><i class="fa fa-envelope"></i> Change email</a></li>

                                    <div id="changeemail"
                                        class="panel-collapse @if (session('success')||session('successmail')) collapse in @else collapse @endif"
                                        aria-expanded="@if (session('success')||session('successmail')) true @else false @endif">

                                        @if ($message = Session::get('successmail'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>

                                        @endif

                                        <form action="{{route('changeemail')}}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Current Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" readonly class="form-control"
                                                        value="{{$crntmail}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">New Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="newemail" class="form-control"
                                                        placeholder="enter new mail">
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="reset" class="btn btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-danger pull-right">Update</button>
                                            </div>
                                            <!-- /.box-footer -->
                                        </form>
                                    </div>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <a data-toggle="collapse" href="#collapseTwo" class=""
                                    aria-expanded="@if (session('success') || session('errorpw') || session('successpw')) true @else false @endif">
                                    <h3 class="box-title"><i class="fa fa-user-shield"></i> Security and Login</h3>
                                </a>
                            </div>
                            <div id="collapseTwo"
                                class="panel-collapse @if (session('success') ||session('errorpw') || session('successpw') ) collapse in @else collapse @endif"
                                aria-expanded="@if (session('success') || session('errorpw') || session('successpw')) true @else false @endif">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a data-toggle="collapse" href="#changeprofilepic" class="collapsed"
                                            aria-expanded="false"><i class="fa fa-camera"></i> Change Profile
                                            Picture</a></li>

                                    <div id="changeprofilepic"
                                        class="panel-collapse @if (session('success')) collapse in @else collapse @endif"
                                        aria-expanded="@if (session('success')) true @else false @endif">

                                        @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        <img src="images/{{ Session::get('image') }}">
                                        @endif


                                        <!-- form start -->
                                        <form action="{{ route('change_propic') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <p class="help-block">select your new profile picture here.</p>
                                                    <input type="file" id="exampleInputFile" name="propic"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <!-- /.box-body -->

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>

                                    <li><a data-toggle="collapse" href="#changepw" class="collapse"
                                            aria-expanded="false"><i class="fa fa-unlock"></i> Change Password</a></li>

                                    <div id="changepw"
                                        class="panel-collapse @if (session('errorpw') || session('successpw')) collapse in @else collapse @endif"
                                        aria-expanded="@if (session('errorpw') || session('successpw')) true @else false @endif">


                                        @if (session('errorpw'))
                                        <div class="alert alert-danger">
                                            {{ session('errorpw') }}
                                        </div>
                                        @endif
                                        @if (session('successpw'))
                                        <div class="alert alert-success">
                                            {{ session('successpw') }}
                                        </div>
                                        @endif

                                        <!-- form start -->
                                        <form class="form-horizontal" method="post"
                                            action="{{ route('change_password') }}">
                                            {{csrf_field()}}
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Current
                                                        Password</label>

                                                    <div class="col-sm-10">
                                                        <input type="password" name="currentpassword"
                                                            class="form-control" id="inputEmail3"
                                                            placeholder="Current Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-2 control-label">New
                                                        Password</label>

                                                    <div class="col-sm-10">
                                                        <input type="password" name="newpassword" class="form-control"
                                                            id="inputPassword3" placeholder="Enter New assword">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword4" class="col-sm-2 control-label">New
                                                        Password Again</label>

                                                    <div class="col-sm-10">
                                                        <input type="password" name="newpasswordagain"
                                                            class="form-control" id="inputPassword4"
                                                            placeholder="Enter New Password Again">
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
                    <img class="profile-user-img img-responsive img-circle" src="{{$image_path}}"
                        alt="User profile picture">

                    <h3 class="profile-username text-center">{{ucWords($name)}}</h3>

                    <p class="text-muted text-center">{{ucFirst($user_type)}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>User ID :</b> <a class="pull-right">{{$id}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email :</b> <a class="pull-right">{{$email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Contact No :</b> <a class="pull-right">{{$tp}}</a>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-warning btn-block"><b>Edit Profile</b></a>
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
                        {{$education}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">{{$location}}</p>

                    <hr>

                    <strong><i class="fa fa-pencil-alt margin-r-5"></i> Skills</strong>
                    <br>
                    <span styles="display:inline-block;" class="label label-danger">Communication Skills</span>
                    <span styles="display:inline-block;" class="label label-success">Emotional Intelligence</span>
                    <span styles="display:inline-block;" class="label label-info">Problem-Solving Skills</span>
                    <span styles="display:inline-block;" class="label label-warning">Attention to Detail</span>
                    <span styles="display:inline-block;" class="label label-primary">Decision-Making Skills</span>
                    {{$skills}}

                    <hr>

                    <strong><i class="fas fa-sticky-note margin-r-5"></i> Notes</strong>

                    <p>{{$notes}}</p>
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

@section('optional_scripts')
<script>
    $(function () {

        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>

@endsection
