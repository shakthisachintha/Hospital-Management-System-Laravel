@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
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
    <li><a href="{{route('check_patient_view')}}"><i class="fas fa-procedures"></i> <span> Check Patient</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fas fa-calendar-check"></i></i><span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('myattend')}}"><i class="fas fa-calendar-day" aria-hidden="true"></i> My Attendance</a></li>
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
@section('content_title',"Create Channel")
@section('content_description',"Create an appointment for the patient from here !")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection
@section('main_content')
        <!-- Main content -->

            {{--  <div class="col-md-3 col-md-offset-4"  >
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <p>Channel No:</p>
                        <h3>44</h3>
                    </div>
                    <a href="#" class="icon"><i class="ion ion-person-add"></i></a>
                    <a href="#" class="small-box-footer">Create Channel <i class="fas fa-plus-circle"></i></a>
                </div>
            </div>  --}}
            <div class="row" id="createchannel1" style="display:none">
                <div class="col-md-3 col-md-offset-4"  >
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <p>Channel No:</p>
                            <h3>44</h3>
                        </div>
                        <a href="#" class="icon"><i class="ion ion-person-add"></i></a>
                        <a href="#" class="small-box-footer">Create Channel <i class="fas fa-plus-circle"></i></a>
                    </div>
                </div>
            </div>

            <div class="box box-info" id="createchannel2" style="display:none">
                <div class="box-header with-border">
                    <h3 class="box-title">Horizontal Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_pname" placeholder="Enter Patient Full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_paddress" placeholder="Enter Patient Address ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Occupation</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_poccupation" placeholder="Enter Patient Occupation ">
                            </div>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sex</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="reg_psex">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-1 control-label">Age</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="reg_page" placeholder="Enter Age">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" value="Register">
                        </div>
                    </div>
                </form>
            </div>

            <div class="box box-info" id="createchannel3">
                <div class="box-header with-border">
                    <h3 class="box-title">Enter Registration No. Or Scan the bar code</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Registration No:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Enter reg No">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-info pull-right" onclick="createchannelfunction()">Enter</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

            <div class="row" id="createchannel4">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Patients appointments Today</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Registration No.</th>
                                    <th>Appointment No.</th>
                                    <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tfoot>
                            </table>
                        </div>
                    <!-- /.box-body -->
                    </div>
                <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
          <!-- /.row -->
        <!-- /.content -->

@endsection

<script>
    function createchannelfunction() {
        $("#createchannel1").slideDown(1000);
        $("#createchannel2").slideDown(1000);
        $("#createchannel3").slideUp(1000);
        $("#createchannel4").slideUp(1000);
    }
</script>

