@extends('template.main')

@section('title', $title)

@section('content_title',__('Discharge Patient'))
@section('content_description',__('Discharge In-Patients Here.'))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  discharge patient  --}}

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







<div class="box box-info" id="disinpatient2"   style="display:none" >
  
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Medical Officer - Abstract of Case')}}</h3>
    </div>

    <form  method="post" action="{{ route('save_disinpatient') }}" class="form-horizontal">
        {{csrf_field()}}
        <div class="box-body">

            <div class="form-group">
                <label for="patient_id" class="col-sm-2 control-label">{{__('Registration No')}}</label>
                <div class="col-sm-2">
                    <input type="text" required readonly class="form-control" name="reg_pid" id="patient_id">
                </div>
            </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" required readonly class="form-control" name="reg_pname" id="patient_name"
                            placeholder="Enter Patient Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">{{__('Address')}}</label>
                    <div class="col-sm-10">
                        <input type="text" required readonly class="form-control" name="reg_paddress"
                            id="patient_address" placeholder="Enter Patient Address ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">{{__('Telephone')}}</label>
                    <div class="col-sm-10">
                        <input type="tel" readonly class="form-control" name="reg_ptel" id="patient_telephone"
                            placeholder="Patient Telephone Number">
                    </div>
                </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Description:')}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reg_medicalofficer1" rows="3" cols="100"
                        placeholder="Enter abstract condition of patient here"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="medofs2" class="col-sm-2 control-label">{{__('Certified by')}}</label>
                <div class="col-sm-10" id="al-box">
                    <input type="text" class="form-control" id="medofs2" name="reg_medicalofficer2" placeholder="Select Your ID here" />
                </div>
            </div>

            <div class="box-footer">
                <input type="submit" class="btn btn-info pull-right" value="Submit">
                <input type="reset" class="btn btn-default" value="Cancel">
            </div>

        </div>

    </form>
</div>

    <div class="box box-info" id="disinpatient1">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Enter Registration No. Or Scan the bar code')}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <label for="pid" class="col-sm-2 control-label">{{__('Registration No:')}}</label>
            <div class="col-sm-8">
                <input type="number" required class="form-control" onchange="dischargeinpatientfunction()" id="pid"
                    placeholder="Enter Registration No" />
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-info" onclick="dischargeinpatientfunction()">Enter</button>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">

    </div>
    <!-- /.box-footer -->
</div>



<script>
    function dischargeinpatientfunction() {
        
        var x, text;
        x = document.getElementById("pid").value;
        patientid=x;
        if (x > 0)
        {
            var data=new FormData;
            data.append('pNum',x);
            data.append('_token','{{csrf_token()}}');


            $.ajax({
                type: "post",
                url: "{{route('disInPatient')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                error: function(data){
                    console.log(data);
                },
                success: function (dp) {
                    if(dp.exist){
                        console.log(dp.name);
                        $("#patient_name").val(dp.name);
                        $("#patient_telephone").val(dp.telephone);
                        $("#patient_address").val(dp.address);
                        $("#patient_id").val(dp.id);

                        $("#disinpatient2").slideDown(1000);
                        $("#disinpatient1").slideUp(1000);
                        console.log('whyyyyy');
                    }else{
                        console.log('not found');
                        alert("Please Enter a Valid In Patient Registration Number!");
                    }
                }
            });
            }else{
                alert("Please Enter a Valid Registration Number!");
            }    
    }

</script>

@endsection