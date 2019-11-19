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

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity Log</a></li>
                    <li class=""><a href="#attendance" data-toggle="tab" aria-expanded="false">My Attendence</a></li>
                    <li
                        class="@if (session('success') || session('errors') ||session('errorpw') || session('successpw') ) active @endif">
                        <a href="#settings" data-toggle="tab"
                            aria-expanded="@if (session('success') || session('errors') ) true @else false @endif">Settings</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
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
                                                        <th>Properties</th>
                                                        <th>Created At</th>
                                                        <th>Updated At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($activity as $app)
                                                    <tr>
                                                        <td>{{$app->description}}</td>
                                                        <td>{{$app->subject_id}}</td>
                                                        <td>{{$app->subject_type}}</td>
                                                        <td>{{$app->causer_type}}</td>
                                                        <td>{{$app->properties}}</td>
                                                        <td>{{$app->created_at}}</td>
                                                        <td>{{$app->updated_at}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <th>Description</th>
                                                    <th>Subject Id</th>
                                                    <th>Subject Type</th>
                                                    <th>Causer Type</th>
                                                    <th>Properties</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
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
                    <div class="tab-pane" id="attendance">
                        <section class="content">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-9">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Messages</span>
                                            <span class="info-box-number">1,410</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-9">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-green"><i class="fa fa-flag"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Bookmarks</span>
                                            <span class="info-box-number">410</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-9">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Uploads</span>
                                            <span class="info-box-number">13,648</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-9">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-red"><i class="fa fa-star"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Likes</span>
                                            <span class="info-box-number">93,139</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="row">

                                </div>

                                <!-- /.col -->
                        </section>
                    </div>


                    <!-- /.tab-pane -->

                    <div class="tab-pane @if (session('success') || session('errors')  ||session('errorpw') || session('successpw') ) active @endif"
                        id="settings">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <a data-toggle="collapse" href="#collapseOne" class="" aria-expanded="true">
                                    <h3 class="box-title"><i class="fa fa-cogs"></i> General</h3>
                                </a>
                            </div>

                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"><i class="fa fa-signature"></i> Edit Profile</a></li>
                                    <li><a href="#"><i class="fa fa-address-book"></i> Change Contact Number</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> Change email</a></li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>

                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <a data-toggle="collapse" href="#collapseTwo" class=""
                                    aria-expanded="@if (session('errors') || session('success') || session('errorpw') || session('successpw')) true @else false @endif">
                                    <h3 class="box-title"><i class="fa fa-user-shield"></i> Security and Login</h3>
                                </a>
                            </div>
                            <div id="collapseTwo"
                                class="panel-collapse @if (session('errors') || session('success') ||session('errorpw') || session('successpw') ) collapse in @else collapse @endif"
                                aria-expanded="@if (session('errors') || session('success') || session('errorpw') || session('successpw')) true @else false @endif">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a data-toggle="collapse" href="#changeprofilepic" class="collapsed"
                                            aria-expanded="false"><i class="fa fa-camera"></i> Change Profile
                                            Picture</a></li>

                                    <div id="changeprofilepic"
                                        class="panel-collapse @if (session('errors') || session('success')) collapse in @else collapse @endif"
                                        aria-expanded="@if (session('errors') || session('success')) true @else false @endif">

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


                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif


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
                    <img class="profile-user-img img-responsive img-circle" src="{{$image_path}}"
                        alt="User profile picture">

                    <h3 class="profile-username text-center">{{$name}}</h3>

                    <p class="text-muted text-center">{{$user_type}}</p>

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
