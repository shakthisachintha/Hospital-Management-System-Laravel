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



<div class="box box-info" id="issuemedicine2" style="display:none">
    <div class="box-header with-border">
        <h3 class="box-title">Approved to Issue Medicine</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body mt-0">
        <h4>Registration No : <span id="patient_id"></span></h4>
        <h4>Patient Name : <span id="p_name"></span></h4>
        <h4>Appointment No &nbsp;: <span id="p_appnum"></span></h4>
        <button type="button" class="btn btn-primary btn-lg mt-3 text-center" value="Issue Medicine Now"
            onclick="issuemedicinefunction2()" id="btn">Issue Medicine Now</button>


    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- box-footer -->

    <!-- /.box -->
</div>




<div class="box box-info" id="issuemedicine1">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Enter Registration No. Or Scan the bar code')}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {{-- <form action="{{route('issueMedicineView')}}" method="post">
            @csrf --}}
            <div class="form-group">
                <label for="p_id" class="col-sm-2 control-label"
                    style="font-size:18px">{{__('Registration No:')}}</label>
                <div class="col-sm-8">
                    <input type="number" required class="form-control" name="patientid"
                        onchange="issuemedicinefunction1()" id="p_id" placeholder="Enter Registration No" />
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info btn-md" onclick="issuemedicinefunction1()">Enter</button>
                </div>
            </div>
        {{-- </form> --}}
    </div>
    <!-- /.box-body -->

    <div class="box-footer">

    </div>
    <!-- /.box-footer -->
</div>

<div class="col-xs-12" id="issuemedicine3" style="display:none">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Prescription</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-active">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" style="text-align:center;font-size:18px">Medicine</th>
                        <th scope="col" style="text-align:center;vertical-align:middle;font-size:18px" rowspan="2">Note
                        </th>
                        <th scope="col" style="text-align:center;vertical-align:middle;font-size:18px" rowspan="2">
                            Issued or Not</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;font-size:18px">English</th>
                        <th style="text-align:center;font-size:18px">Sinhala</th>
                    </tr>
                </thead>
                <tbody id="bodyData">
                    @foreach ($pmedicines as $med)
                    <tr>
                        <td style="text-align:center;font-size:15px;color:blue;">{{ $med->name_english }}</td>
                        <td style="text-align:center;font-size:15px;color:blue;">{{ $med->name_sinhala }}</td>
                        <td style="text-align:center;font-size:15px;color:blue;">{{ $med->note }}</td>
                        <td style="text-align:center;font-size:15px;color:blue;"><button
                                style="font-size:20px;color:green;" class='fa fa-check btn-md'></button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ csrf_field() }}
        </div>
    </div>
</div>

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
                        $("#p_appnum").text(im.appNum)

                       

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