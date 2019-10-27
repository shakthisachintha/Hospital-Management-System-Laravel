@extends('template.main')

@section('title', $title)

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
            <li><a href="{{route('patient')}}"></i><i class="fas fa-user-plus" aria-hidden="true"></i> Register New</a>
            </li>
            <li><a href="#"></i><i class="fas fa-id-card" aria-hidden="true"></i> Search Patient</a></li>
{{--register in patient--}}
            <li><a href="{{route('register_in_patient_view')}}"><i class="fas fa-user-plus" area-hidden="true"></i><span> Register In Patient</span></a></li>

        </ul>
    </li>
    {{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Appoinment</span></a>
    </li>
    {{--check patient--}}
    <li class="active"><a href="{{route('check_patient_view')}}"><i class="fas fa-procedures"></i><span> Check Patient</span></a></li>
    
       
    <li class="treeview">
        <a href="#"><i class="fas fa-calendar-check"></i></i><span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('myattend')}}"><i class="fas fa-calendar-day" aria-hidden="true"></i> My Attendance</a>
            </li>
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
            <li><a href="{{route('newuser')}}"> <i class="fa fa-user-plus" aria-hidden="true"></i>New User</a></li>
            <li><a href="{{route('regfinger')}}"><i class="fa fa-fingerprint" aria-hidden="true"></i>Register
                    Fingerprint</a></li>
            <li><a href="{{route('resetuser')}}"><i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}

    <li><a href="{{route('profile')}}"><i class="fas fa-user"></i><span> Profile</span></a></li>
</ul>

@endsection
@section('content_title',"Check Patient")
@section('content_description',"Check Patient here and update history from here !")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection
@section('main_content')


<script>
$(document).ready(function () {
  $("#appNum").focus();
});

function validateNum(appNum){
    var data=new FormData;
    data.append('number',appNum);
    data.append('_token','{{csrf_token()}}');
    
    $.ajax({
    type: "POST",
    url: "{{route('validateAppNum')}}",
    processData: false,
    contentType: false,
    cache: false,
    data:data,
    error: function(data){
        console.log(data);
    },
    success: function (appointment) {
        if(appointment.exist){
          $("#btn_submit").removeAttr("disabled");
          $("#btn_submit").focus();
          $("#details").fadeIn();
          $("#p_name").text(appointment.name);
          $("#appt_num").text(appointment.appNum);
        }else{
          $("#validation").text("Invalid Appointment Number Or Patient Number. Check Again...");
          $("#appNum").focus();
        }
    }
});
}

</script>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Check Patient</h3>
                    </div>
                    <div class="box-body mt-0">
                    <form class="pl-5 pr-5 pb-5" method="post" action="{{route('checkPatient')}}">
                        @csrf
                            <h3>Enter Appointment Number Or Patient Number To Begin</h3>
                            <input id="appNum" name="appNum" class="form-control input-lg" type="number" onchange="validateNum(this.value)" placeholder="Appointment Number Or Patient Number">
                            <input disabled id="btn_submit" type="submit" class="btn btn-primary btn-lg mt-3 text-center" value="Check Patient">
                            <p id="validation" class="mt-2 text-danger"></p>
                            <div style="display:none" id="details">
                                <h4>Patient Name : <span id="p_name"></span></h4>
                                <h4>Appointment &nbsp;: <span id="appt_num"></span></h4>
                            </div>
                          </form> 
                    </div>
            </div>
    </div>
    <div class="col-md-1"></div>
    
</div>

@endsection
