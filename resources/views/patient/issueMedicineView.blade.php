@extends('template.main')

@section('title', $title)

@section('content_title',"Pharamacy")
@section('content_description',"Issue Medicines here.")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div class="row mt-5 pt-5">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box box-info" id="issuemedicine1">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Enter Patient Registration Number Or The Appointment Number')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



                <div class="form-group">
                    <label for="p_id" class="control-label"
                        style="font-size:18px">{{__('Registration or Appointment No:')}}</label>
                    <input type="number" required class="form-control mt-2" name="patientid"
                        onchange="issuemedicinefunction1()" id="p_id"
                        placeholder="Enter Registration or Appointment Number" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info" onclick="issuemedicinefunction1()">Check</button>
                </div>


            </div>
            <!-- /.box-body -->

            <div class="box-footer">

            </div>
            <!-- /.box-footer -->
</div>


<div class="box box-info" id="issuemedicine2" style="display:none">
            <div class="box-header with-border">
                <h3 class="box-title">Approved to Issue Medicine</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body mt-0">
                <h4>Registration No : <span id="patient_id"></span></h4>
                <h4>Patient Name : <span id="p_name"></span></h4>
                <h4>Appointment No &nbsp;: <span id="p_appnum"></span></h4>
                <button id="btn-issue" type="button" class="btn btn-primary btn-lg mt-3 text-center"
                    value="Issue Medicine Now" onclick="go()" id="btn">Issue Medicine Now</button>
                <button onclick="cancel()" class="btn btn-warning btn-lg mt-3 text-center">Cancel</button>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- box-footer -->

            <!-- /.box -->
        </div>
    </div>
    <div class="col-md-1"></div>
</div>



<script>
    var presid=1;
    function go(){
        window.location.href="/issue/"+presid;
    }

    function cancel(){
        $("#issuemedicine2").slideUp(1000);
        $("#issuemedicine1").slideDown(1000);
    }
</script>


<script>
    function issuemedicinefunction1() {
        
        var x, text;
        x = document.getElementById("p_id").value;
        patientid=x;
        if (x > 0)
        {
            var data=new FormData;
            data.append('pNum',x);
            data.append('_token','{{csrf_token()}}');


            $.ajax({
                type: "post",
                url: "{{route('issueMedicine2')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                error: function(data){
                    console.log(data);
                },
                success: function (im) {
                    if(im.exist){
                        console.log(im.name);
                        $("#p_name").text(im.name);
                        $("#patient_id").text(im.pNUM);
                        $("#p_appnum").text(im.appNum);
                        presid=im.pres_id;
                        $("#btn-issue").focus();
                        $("#issuemedicine2").slideDown(1000);
                        $("#issuemedicine1").slideUp(1000);
                        console.log('check');
                    }else{
                        console.log('not found');
                        alert("Please Enter Today Prescriptions' Details only!");
                    }
                }
            });
            }else{
                alert("Please Enter a Valid Registration Number!");
            }  
    }

    function issuemedicinefunction2()
    {
       
        $("#issuemedicine3").slideDown(1000);
        document.getElementById("btn").disabled = true;
        
    }

</script>













@endsection