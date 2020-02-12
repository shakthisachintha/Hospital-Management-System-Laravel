@extends('template.main')

@section('title', $title)

@section('content_title',__('In Patient Registration'))
@section('content_description',__('Register New In Patients Here.'))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  patient registration  --}}

<div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else
    style="margin-bottom:0;margin-top:8vh" @endif class="row">
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



<div class="box box-info" id="reginpatient2" style="display:none">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Pre Registration Form')}}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form method="post" action="{{ route('save_inpatient') }}" class="form-horizontal">
        {{csrf_field()}}
        <form method="post" action="{{ route('save_inpatient') }}" class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}<span
                            style="color:red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" name="reg_pname" id="patient_name"
                            placeholder="Enter Patient Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">{{__('NIC Number')}}</label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" name="reg_pnic" id="patient_nic"
                            placeholder="National Identity Card Number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">{{__('Address')}}<span
                            style="color:red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" name="reg_paddress"
                            id="patient_address" placeholder="Enter Patient Address ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">{{__('Telephone')}}</label>
                    <div class="col-sm-10">
                        <input type="tel"  class="form-control" name="reg_ptel" id="patient_telephone"
                            placeholder="Patient Telephone Number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">{{__('Occupation')}}</label>
                    <div class="col-sm-10">
                        <input type="text" required  class="form-control" name="reg_poccupation"
                            id="patient_occupation" placeholder="Enter Patient Occupation ">
                    </div>
                </div>

                <!-- select -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Sex')}}<span style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <select required  class="form-control" name="reg_psex" id="patient_sex">
                            <option selected value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <label for="patient_age"  class="col-sm-2 control-label">{{__('Age')}}<span
                            style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input type="text"  class="form-control" name="reg_page" id="patient_age"
                            placeholder="Enter Age">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Civil Condition')}}</label>
                    <div class="col-sm-2">
                        <select required class="form-control" name="reg_ipcondition">
                            <option selected value="Male">Single</option>
                            <option value="Female">Married</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Birth Place')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipbirthplace"
                            placeholder="Patient Birth place">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Nationality')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipnation" placeholder="Sri Lankan or another">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Religion')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipreligion" placeholder="Patient Religion">
                    </div>
                </div>

                <!-- currency input type -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Monthly Income')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">{{__('Rs:')}}</span>
                            <input type="number" min="1000" step="1000.00" data-number-to-fixed="2"
                                data-number-stepfactor="100" class="form-control currency" name="reg_inpincome">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Name of Patient/Guardian')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipguardname"
                            placeholder="Enter Name of any responsible person of patient">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Address of Patient/Guardian')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipguardaddress"
                            placeholder="Enter Address of any responsible person of patient">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Inventory of patient')}}</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="reg_ipinventory" rows="3" cols="100"
                            placeholder="Enter inventory list of patient"></textarea>
                    </div>
                </div>
            </div>
        </form>


        <div class="box-header with-border">
            <h3 class="box-title">{{__('Ward Registration Form')}}</h3>
        </div>

        <form method="post" action="{{ route('save_inpatient') }}" class="form-horizontal">
            <div class="box-body">
                <div class="form-group">

                    <label class="col-sm-2 control-label">{{__('Ward No')}}<span style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input type="number" required min="01" class="form-control" name="reg_ipwardno">
                    </div>

                    <label class="col-sm-2 control-label">{{__('Date of Admission')}}</label>
                    <div class="col-sm-2">
                        <input type="date" onload="getDate()" class="form-control" name="reg_ipdate">
                    </div>

                    <label class="col-sm-2 control-label">{{__('Time of Admission')}}</label>
                    <div class="col-sm-2">
                        <input type="time" onload="getTime()" class="form-control" name="reg_inptime">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Approved Physician/Surgeon')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipapprovedoc"
                            placeholder="Name of Physician/Surgeon">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Physician/Surgeon In Charge')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_ipinchrgedoc"
                            placeholder="Name of Physician/Surgeon">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('House Physician/Surgeon')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_iphousedoc"
                            placeholder="Name of Physician/Surgeon">
                    </div>
                </div>

            </div>
        </form>

        <div class="box-header with-border">
            <h3 class="box-title">{{__('Admitting Officer - Notes')}}</h3>
        </div>

        <form method="post" action="{{ route('save_inpatient') }}" class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="dis1" class="col-sm-2 control-label">{{__('Disease')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="dis1" placeholder="Enter diagnosis of patient" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Duration of illness')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">{{__('Days:')}}</span>
                            <input type="number" min="1" step="1" data-number-to-fixed="2" data-number-stepfactor="100"
                                class="form-control currency" name="reg_admitofficer2" id="dis2">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dis3"
                        class="col-sm-2 control-label">{{__('Mode of arises and current condition:')}}</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="reg_admitofficer3" id="dis3" rows="3" cols="100"
                            placeholder="Enter current condition of patient here"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dis4" class="col-sm-2 control-label">{{__('Certified by')}}</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="dis4" placeholder="Select Your ID here" />
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

        </form>

        <div class="box-footer">
            <input type="submit" class="btn btn-info pull-right" value="Register">
            <input type="reset" class="btn btn-default" value="Cancel">
        </div>

</div>
</form>




<div class="box box-info" id="reginpatient3">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Enter Registration No. Or Scan the bar code')}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <label for="pID" class="col-sm-2 control-label">{{__('Registration No:')}}</label>
            <div class="col-sm-8">
                <input type="number" required class="form-control" onchange="registerinpatientfunction()" id="pID"
                    placeholder="Enter Registration No" />
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-info" onclick="registerinpatientfunction()">Enter</button>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">

    </div>
    <!-- /.box-footer -->
</div>



<div class="box box-info" id="reginpatient5" style="display:none">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Medical Officer - Abstract of Case')}}</h3>
    </div>

    <form class="form-horizontal">
        <div class="box-body">

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Description:')}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reg_medicalofficer1" rows="3" cols="100"
                        placeholder="Enter abstract condition of patient here"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">{{__('Date of Discharge/Death')}}</label>
                <div class="col-sm-2">
                    <input type="date" onload="getDate()" class="form-control" name="reg_medicalofficer2">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Diagnosis')}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reg_medicalofficer3" rows="3" cols="100"
                        placeholder="Enter abstract diagnosis of patient here"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Certified by')}}</label>
                <div class="col-sm-10" id="al-box">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Select Your ID here" />
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
        
        var x, text;
        x = document.getElementById("pID").value;
        patientid=x;
        if (x > 0)
        {
            var data=new FormData;
            data.append('pNum',x);
            data.append('_token','{{csrf_token()}}');


            $.ajax({
                type: "post",
                url: "{{route('regInPatient')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                error: function(data){
                    console.log(data);
                },
                success: function (patient) {
                    if(patient.exist){
                        console.log(patient.name);
                        $("#patient_name").val(patient.name);
                        $("#patient_age").val(patient.age);
                        $("#patient_sex").val(patient.sex);
                        $("#patient_telephone").val(patient.telephone);
                        $("#patient_nic").val(patient.nic);
                        $("#patient_address").val(patient.address);
                        $("#patient_occupation").val(patient.occupation);
                        

                        $("#reginpatient2").slideDown(1000);
                        $("#reginpatient3").slideUp(1000);
                       
                    }else{
                        console.log('not found');
                        alert("Please Enter a Valid Registration Number!");
                    }
                }
            });
            }else{
                alert("Please Enter a Valid Registration Number!");
            }    
    }

    function reginpatientform2function(){
        
        $("#reginpatient4").slideDown(1000);
        $("#reginpatient2").slideUp(1000);

    }

    function reginpatientform3function(){
        
        $("#reginpatient5").slideDown(1000);
        $("#reginpatient2").slideUp(1000);

    }

   

</script>



@endsection