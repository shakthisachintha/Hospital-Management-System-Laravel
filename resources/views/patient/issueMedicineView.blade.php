@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a></li>
{{--patient--}}
    <li class="treeview active">
        <a href="#"><i class="fas fa-user-injured"></i><span> Patient</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('patient')}}"></i><i class="fas fa-user-plus" aria-hidden="true"></i> Register New</a></li>
            <li><a href="#"></i><i class="fas fa-id-card" aria-hidden="true"></i> Search Patient</a></li>
 {{--register in patient--}}
            <li class="active"><a href="{{route('register_in_patient_view')}}"><i class="fas fa-user-plus" area-hidden="true"></i><span> Register In Patient</span></a></li>
        </ul>
    </li>
{{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Appoinment</span></a></li>
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
@section('content_title',"Pharamacy")
@section('content_description',"Issue medicines here.")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  issue medicine  --}}

    <div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else style="margin-bottom:0;margin-top:8vh" @endif class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                    @if (session()->has('regpsuccess'))
                        <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                {{session()->get('regpsuccess')}}
                        </div>
                              @endif
                              @if (session()->has('regpfail'))
                        <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    {{session()->get('regpfail')}}
                        </div>
                                  @endif

            </div>
        <div class="col-md-1"></div>

    </div>

        

    

    <div class="box box-info" id="issuemedicine1">
                <div class="box-header with-border">
                    <h3 class="box-title">Enter Registration No. Or Scan the bar code</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" >
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Registration No:</label>
                            <div class="col-sm-10" id="al-box">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Enter reg No"/>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    
                </form>

                <div class="box-footer">
                        <button type="button" class="btn btn-info pull-right"  onclick="issuemedicinefunction()">Enter</button>
                    </div>
                    <!-- /.box-footer -->
           

        </div>


        <div class="row" id="issuemedicine2" style="display:none">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Prescription</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Appointment No.</th>
                            <th>Medicine</th>
                            <th>Issued or Not</th>

                        </tr>
                    </thead>
                    
                    

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

        
        

       





            


   

    
<script>

    function issuemedicinefunction() {
        

        var x;
        x = document.getElementById("inputEmail3").value;
        if (x == 0) 
        {
            alert("Please Enter a Registration Number!");
            window.location.$("#issuemedicine1");
        }

        $("#issuemedicine2").slideDown(1000);
        $("#issuemedicine1").slideUp(1000);
       
    }

    
   

</script>



@endsection