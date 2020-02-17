@extends('template.main')

@section('title', $title)

@section('content_title',__("Create Appoinments"))
@section('content_description',__("Create an appointment for the patient from here !"))
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
    <div class="col-md-3 col-md-offset-4">
        <!-- small box -->
        <div style="cursor:pointer" id="makeBtn" onclick="makeChannel();" class="small-box bg-yellow">
            <div style="cursor:pointer" class="inner">
                <p>Channel No:</p>
                <h3 id="appt_num"></h3>
            </div>
            <a href="#" class="icon"><i class="ion ion-person-add"></i></a>
            <a href="#" class="small-box-footer">{{__('Create Channel')}}<i class="fas fa-plus-circle"></i></a>
        </div>
    </div>
</div>

<div style="display:none" id="createchannel2" class="row">
    <!-- right column -->
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Details Of The Patient')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" name="reg_pname" id="patient_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{__('NIC Number')}}</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" name="reg_pnic" id="patient_nic">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Address')}}</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" name="reg_paddress" id="patient_address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Telephone')}}</label>
                        <div class="col-sm-10">
                            <input type="tel" readonly class="form-control" id="patient_telephone" name="reg_ptel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Occupation')}}</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="patient_occupation"
                                name="reg_poccupation">
                        </div>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Sex')}}</label>
                        <div class="col-sm-3">
                            <select id="patient_sex" readonly class="form-control" name="reg_psex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <label for="inputEmail3" class="col-sm-1 control-label">{{__('Age')}}</label>
                        <div class="col-sm-2">
                            <input type="number" readonly id="patient_age" min="1" class="form-control" name="reg_page">
                        </div>
                    </div>
                    <div class="box-footer">
                        {{-- <input type="submit" class="btn btn-info pull-right" value="{{__('Register')}}">
                        <input type="reset" class="btn btn-default" value="{{__('Cancel')}}"> --}}
                    </div>
                    <!-- /.box-footer -->
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<div class="box box-info" id="createchannel3">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Enter Registration No. Or Scan The Bar Code')}}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="p_reg_num" class="col-sm-2 control-label">{{__('Registration No:')}}</label>
                <div class="col-sm-8">
                    <input type="number" onchange="createChannelFunction()" required class="form-control" id="p_reg_num"
                        placeholder="Enter Patient Registration Number">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-info" onclick="createChannelFunction()">Enter</button>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer -->
    </div>
</div>

<div class="row" id="createchannel4">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('Patients Appointments Today')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{__('Registration No.')}}</th>
                            <th>{{__('Appointment No.')}}</th>
                            <th>{{__('Name')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $app)
                        <tr>
                            <td>{{$app->patient_id}}</td>
                            <td>{{$app->number}}</td>
                            <td>{{$app->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>{{__('Registration No.')}}</th>
                        <th>{{__('Appointment No.')}}</th>
                        <th>{{__('Name')}}</th>
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

<script>
    var patientid;
    function makeChannel(){
        $("#makeBtn").hide();
        var data=new FormData;
        data.append('_token','{{csrf_token()}}');
        data.append('id',patientid);
        $.ajax({
            type: "post",
            url: "{{route('makeappoint')}}",
            processData: false,
            contentType: false,
            cache: false,
            data:data,
            success: function (response) {
                location.reload();
            }
        });
    }

    function createChannelFunction() {

        var x, text;
        x = document.getElementById("p_reg_num").value;
        patientid=x;
        if (x > 0)
        {
            var data=new FormData;
            data.append('regNum',x);
            data.append('_token','{{csrf_token()}}');


            $.ajax({
                type: "post",
                url: "{{route('makechannel')}}",
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
                        $("#appt_num").text(patient.appNum);

                        $("#createchannel1").slideDown(1000);
                        $("#createchannel2").slideDown(1000);
                        $("#createchannel3").slideUp(1000);
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

</script>

@endsection

@section('optional_scripts')
<script>
    $(function () {

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>

@endsection