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
{{--  issue medicine  --}}

<script>
    $(document).ready(function () {
  $("#appNum").focus();
});

function validateId(appNum){
    var data=new FormData;
    data.append('number',appNum);
    data.append('_token','{{csrf_token()}}');
    
    $.ajax({
    type: "POST",
    url: "{{route('pharmacyValidate')}}",
    processData: false,
    contentType: false,
    cache: false,
    data:data,
    error: function(data){
        console.log(data);
    },
    success: function (prescription) {
        if(prescription.exist){
          $("#btn_submit").removeAttr("disabled");
          $("#btn_submit").focus();
          $("#details").fadeIn();
          $("#p_name").text(prescription.name);
          $("#pnum").val(prescription.pNum)
          $("#appt_num").text(prescription.appNum);
          $("#appt_num_1").val(prescription.appNum);
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
                <h3 class="box-title">Issue Medicine</h3>
            </div>
            <div class="box-body mt-0">
                <form class="pl-5 pr-5 pb-5" method="post" action="{{route('issueMedicine')}}">
                    @csrf
                    <h3>Enter Appointment Number Or Patient Number To Begin</h3>
                    <input id="appNum" class="form-control input-lg" type="number"
                        onchange="validateId(this.value)" placeholder="Appointment Number Or Patient Number">
                    <input disabled id="btn_submit" type="submit" class="btn btn-primary btn-lg mt-3 text-center"
                        value="Issue Medicine">
                    <input name="pid" type="hidden" id="pnum">
                    <input name="appNum" type="hidden" id="appt_num_1">
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






{{-- <div class="row" id="issuemedicine2" style="display:none">
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
<!-- /.content --> --}}













@endsection