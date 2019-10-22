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
@section('content_title',"In Patient Registration")
@section('content_description',"Register New In Patients Here.")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  patient registration  --}}

<<<<<<< HEAD
    <div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else style="margin-bottom:0;margin-top:8vh" @endif class="row">
        <div class="col-md-1"></div>
=======
        <div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else style="margin-bottom:0;margin-top:4vh" @endif class="row">
            <div class="col-md-1"></div>
>>>>>>> origin
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

<<<<<<< HEAD
        

    <div class="box box-info" id="reginpatient2" style="display:none">
        <div class="box-header with-border">
            <h3 class="box-title">Pre Registration Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            <form class="form-horizontal">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" name="reg_pname" placeholder="Enter Patient Full Name">
=======
            <div class="box box-info" id="reginpatient2" style="display:none">
                <div class="box-header with-border">
                    <h3 class="box-title">Pre Registration Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" name="reg_pname" placeholder="Enter Patient Full Name">
                            </div>
>>>>>>> origin
                        </div>
                    </div>
                        
                    <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">NIC Number</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" name="reg_pnic" placeholder="National Identity Card Number">
                            </div>
                    </div>
                        
                    <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Address <span style="color:red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" name="reg_paddress" placeholder="Enter Patient Address ">
                            </div>
                    </div>
                        
                    <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" name="reg_ptel" placeholder="Patient Telephone Number">
                            </div>
                    </div>
                        
                    <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Occupation</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" name="reg_poccupation" placeholder="Enter Patient Occupation ">
                            </div>
                    </div>

                        <!-- select -->
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Sex <span style="color:red">*</span></label>
                            <div class="col-sm-2">
                                <select required class="form-control" name="reg_psex">
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 control-label">Age <span style="color:red">*</span></label>
                            <div class="col-sm-2">
                                <input type="number" required min="1" class="form-control" name="reg_page" placeholder="Enter Age">
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Civil Condition</label>
                            <div class="col-sm-2">
                                <select required class="form-control" name="reg_ipcondition">
                                    <option selected value="Male">Single</option>
                                    <option value="Female">Married</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Birth Place</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipbirthplace" placeholder="Patient Birth place">
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Nationality</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipnation" placeholder="Sri Lankan or another">
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Religion</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipreligion" placeholder="Patient Religion">
                            </div>
                    </div>

                        <!-- currency input type -->
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Monthly Income</label>
                            <div class="col-sm-10">
                                <div class="input-group"> 
                                    <span class="input-group-addon">Rs:</span>
                                    <input type="number" min="1000" step="1000.00" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" name="reg_inpincome">
                                </div>
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Name of Patient/Guardian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipguardname" placeholder="Enter Name of any responsible person of patient">
                            </div>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address of Patient/Guardian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipguardaddress" placeholder="Enter Address of any responsible person of patient">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Inventory of patient</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name = "reg_ipinventory" rows = "3" cols = "100" placeholder="Enter inventory list of patient"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                        

                <div class="box-header with-border">
                    <h3 class="box-title">Ward Registration Form</h3>
                </div>
                        
                <form class="form-horizontal">
                    <div class="box-body">  
                        <div class="form-group">
                            
                            <label class="col-sm-2 control-label">Ward No<span style="color:red">*</span></label> 
                            <div class="col-sm-2">
                                <input type="number" required min="01" class="form-control" name="reg_ipwardno">
                            </div>
                            
                            <label class="col-sm-2 control-label">Date of Admission</label> 
                            <div class="col-sm-2">
                                <input type="date" onload="getDate()" class="form-control" name="reg_ipdate">
                            </div>
                            
                            <label class="col-sm-2 control-label">Time of Admission</label> 
                            <div class="col-sm-2">
                                <input type="time" onload="getTime()" class="form-control" name="reg_inptime">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Approved Physician/Surgeon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipapprovedoc" placeholder="Name of Physician/Surgeon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Physician/Surgeon In Charge</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_ipinchrgedoc" placeholder="Name of Physician/Surgeon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">House Physician/Surgeon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reg_iphousedoc" placeholder="Name of Physician/Surgeon">
                            </div>
                        </div>

                    </div>
                </form>
            
                <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" value="Register">
                    <input type="reset" class="btn btn-default" value="Cancel">
                </div>

                <div class="p-2 mt-5 ml-1 mr-1">
                    <button type="button" class="btn btn-block btn-success btn-md" onclick="reginpatientform2function()" >Notes of Admitting Officer</button>
                    <br>
                    <button type="button" class="btn btn-block btn-success btn-md">Abstract of case by Medical officer</button>
                </div>
            </div> 
        </form> 
 

    

    <div class="box box-info" id="reginpatient3">
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
                        <button type="button" class="btn btn-info pull-right"  onclick="registerinpatientfunction()">Enter</button>
                    </div>
                    <!-- /.box-footer -->
           

        </div>


        <div class="box box-info" id="reginpatient4" style="display:none">
                <div class="box-header with-border">
                    <h3 class="box-title">Admitting Officer - Notes</h3>
                </div>
                
                <form class="form-horizontal" >
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Disease:</label>
                            <div class="col-sm-10" id="al-box">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Enter diagnosis of patient"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Duration of illness</label>
                            <div class="col-sm-10">
                                <div class="input-group"> 
                                    <span class="input-group-addon">Days:</span>
                                    <input type="number" min="1" step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" name="reg_admitofficer2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Mode of arises and current condition:</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name = "reg_admitofficer3" rows = "3" cols = "100" placeholder="Enter current condition of patient here"></textarea>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    
                </form>

                <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" value="Submit">
                    <input type="reset" class="btn btn-default" value="Cancel">
                </div>
                    <!-- /.box-footer -->
           

        </div>

        

       





            


   

    
<script>

    function registerinpatientfunction() {
        

        var x;
        x = document.getElementById("inputEmail3").value;
        if (x == 0) 
        {
            alert("Please Enter a Registration Number!");
            window.location.$("#reginpatient3");
        }

        $("#reginpatient2").slideDown(1000);
        $("#reginpatient3").slideUp(1000);
       
    }

    function reginpatientform2function(){
        
        $("#reginpatient4").slideDown(1000);
        $("#reginpatient2").slideUp(1000);

    }

   

</script>



@endsection