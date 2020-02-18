@extends('template.main')

@section('title', $title)

@section('optional_scripts')
@endsection

@section('content_title',__('Check Patient'))
@section('content_description',__('Check Patient here and update history from here !'))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection
@section('main_content')


<script src="js/typeahead/typeahead.bundle.js"></script>
{{-- <script src="js/typeahead/typeahead.jquery.js"></script> --}}
<script src="js/typeahead/bloodhound.js"></script>



<div class="row">

    <div class="col-md-6">
        <div style="height:46.5vh;overflow-y:scroll;overflow-x:hidden;" class="mt-2 mb-1 box box-dark">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class="fas fa-notes-medical"></i>&nbsp;Channel & Patient's Details</h3>
            </div>
            <div class="box-body">
                <h4>Appointment Number : {{$appNum}}</h4>
                <h4>Name : {{$pName}}</h4>
                <h4>Age & Sex : {{$pAge}} {{$pSex}}</h4>
                @if ($pBloodPressure->flag)
                <h4>Blood Pressure : <span
                        class="h4 @if ($pBloodPressure->sys>130 || $pBloodPressure->dia>90) text-red @elseif ($pBloodPressure->sys>125 || $pBloodPressure->dia>85) text-yellow @else text-green @endif ">
                        {{$pBloodPressure->sys}}/{{$pBloodPressure->dia}}
                        mmHg</span><small> (Updated
                        {{explode(" ",$pBloodPressure->date)[0]}})</small></h4>
                @endif

                @if($pBloodSugar->flag)
                <h4>Blood Glucose Levels : <span
                        class="h4 @if($pBloodSugar->value > 72 && $pBloodSugar->value<100) text-green @else text-red @endif">{{$pBloodSugar->value}}
                        mg/dL</span><small> (Updated
                        {{explode(" ",$pBloodSugar->date)[0]}})</small></h4>
                @endif

                @if ($pCholestrol->flag)
                <h4>General Cholestrol Level : <span
                        class="h4 @if($pCholestrol->value>220) text-red @elseif($pCholestrol->value>200) text-yellow @else text-green @endif">{{$pCholestrol->value}}
                        mg/dL</span><small>
                        (Updated {{explode(" ",$pCholestrol->date)[0]}})</small></h4>
                @endif
                <div class="row mt-2 mb-0 pb-0">
                    <div class="col-md-3 mt-2 mb-0 pb-0">
                        <button onclick="window.open('{{route('patientHistory',$pid)}}','myWin','scrollbars=yes,width=720,height=690,location=no').focus();" class="btn btn-info">
                            View Patient History
                        </button>
                    </div>
                    <div class="col-md-3 mt-2 mb-0 pb-0">
                        <button data-toggle="modal" data-target="#modal-clinics" class="btn btn-primary">
                            Assign To Clinic
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#clinic-form").submit(function(e) {
            
            e.preventDefault(); // avoid to execute the actual submit of the form.
            
            var form = $(this);
            var url = form.attr('action');
        
            $.ajax({
                   type: "POST",
                   url: url,
                   processData: false,
                        
                        cache: false,
                   headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                   },
                   data: $('#clinic-form').serialize(), // serializes the form's elements.
                   success: function(response)
                   {
                       if(response.code==200){
                        $("#clinic").html(response.html_list);
                        $("#already").html(response.html_already);

                       }
                       console.log(response); // show response from the php script.
                   },
                   error:function(response){
                       console.log(response);
                   }
     });


});
    });
    </script>
    <div class="modal fade" id="modal-clinics">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Assign To Clinics</h3>
                </div>
                <div id="clinics" class="modal-body">
                    <h4>This Patient Is Already Assigned To </h4>
                    <div id="already">
                        @foreach ($assinged_clinics as $clinic)
                        <span style="font-size:15px;display:inline-block"
                            class="label mt-1 mb-1 bg-blue">{{$clinic->name_eng}}</span>
                        @endforeach
                    </div>
                    <div class="mt-3 pt-1">

                        <form action="{{route('addToClinic')}}" method="POST" id="clinic-form">
                            <input type="hidden" name="pid" value="{{$pid}}">
                            <h4 for="clinic">Assign To a New Clinic <small>( CTRL+Click To Select Multiple )</small>
                            </h4>
                            <select class="form-control" name="clinic[]" multiple id="clinic">

                                @foreach ($clinics as $clinic)
                                @php
                                $flag=0;
                                @endphp
                                @foreach($assinged_clinics as $key)
                                @if($clinic->id==$key->id)
                                @php
                                $flag=1;
                                @endphp
                                @endif
                                @endforeach
                                @if ($flag==0)
                                <option value={{$clinic->id}}>{{$clinic->name_eng}}({{$clinic->name_sin}})</option>
                                @endif
                                @endforeach
                            </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="rounded col-md-6">

        <div style="height:46.5vh;" class="box box-dark mb-1 mt-2">
            <div class="box-header with-border">
                Add Medicines To Prescription
            </div>
            <div class="box-body">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-5 m-0 p-0">
                            <div id="bloodhound">
                                <input oninput="console.log(this.value);" id="medSearch" class="form-control"
                                    type="text" placeholder="Search Medicines">
                            </div>
                        </div>
                        <div class="col-md-7 m-0 p-0">
                            <input onkeydown="addMed(event,this)" id="medNote" disabled type="text" class="form-control"
                                placeholder="Notes">
                        </div>
                        <div id="suggestionList"></div>
                    </div>
                </div>


                <div style="height:30vh;overflow-y: scroll">
                    <table style="width:100%" id="medTable" class="table table-sm table-bordered w-100">

                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 40%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 20%;">
                        </colgroup>

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Medicine</th>
                                <th>Notes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="m-0 p-0">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        var medicines=[];
        var patient_id={{$pid}};
        var app_num={{$appNum}};

        $(document).ready(function () {
            if(sessionStorage.getItem('app')=={{$appNum}}){
                sessionStorage.setItem('app',{{$appNum}});
                if(sessionStorage.getItem("medicines")){
                medicines=JSON.parse(sessionStorage.getItem("medicines"));
                medTableUpdate();
                $("#diagnosys").val(sessionStorage.getItem('diagnosys'));
                $("#cholestrol").val(sessionStorage.getItem('cholestrol'));
                $("#glucose").val(sessionStorage.getItem('glucose'));
                $("#pressure").val(sessionStorage.getItem('pressure'));
                console.log("Found");
                }else{
                console.log("not found");
                return;
                }
            }
            sessionStorage.setItem('app',{{$appNum}});

            $("#diagnosys").change(function (e) { 
                var diag=$("#diagnosys").val();
                sessionStorage.setItem('diagnosys',diag)
            });

            $("#cholestrol").change(function (e) { 
                sessionStorage.setItem('cholestrol',$("#cholestrol").val());
            });

            $("#glucose").change(function (e) { 
                sessionStorage.setItem('glucose',$("#glucose").val());
            });
            $("#pressure").change(function (e) { 
                sessionStorage.setItem('pressure',$("#pressure").val());
            });
         });

        function addMed(e,obj) { 
            var note=obj.value;
            var med=$("#medSearch").val();
            if(e.keyCode === 13){
                e.preventDefault();
                var id = Math.floor(1000 + Math.random() * 9000); 
                var med={id:id,name:med,note:note}
                medicines.push(med);
                medTableUpdate();
                $("#medSearch").val('');
                $("#medSearch").focus();
                $('#medSearch').typeahead('val', '');
                $('#medSearch').typeahead('close');

                $("#medNote").val('');
                $("#medNote").attr('disabled', 'disabled');
            }else if(e.keyCode===9){
                e.preventDefault();
            }
         }

         function medTableUpdate() {
            medicines = medicines.filter(function (el) {
            return el != null;
            });
            sessionStorage.setItem("medicines", JSON.stringify(medicines));
            $("#medTable tbody tr").remove();
            var count=1
             medicines.forEach(element => {
                $('#medTable > tbody:last-child').append('<tr><td>'+count+'</td><td>'+element.name+'</td><td>'+element.note+'</td><td><div class="btn-group"><button onclick="delMed('+element.id+')" style="height:28px;" type="button" class="m-0 btn btn-danger btn-sm btn-flat"><i class="far fa-trash-alt"></i></button><button style="height:28px;" onclick="editMed('+element.id+')" type="button" class="btn m-0 btn-warning btn-sm btn-flat"><i class="far fa-edit"></i></button></div></td></tr>');
                count++;
             });
         }

         function editMed(id){
             $("#medSearch").val()
             count=0;
             medicines.forEach(element=>{
                if(element.id==id){
                    $("#medSearch").val(element.name);
                    $("#medNote").removeAttr("disabled");
                    $("#medNote").val(element.note);
                    $("#medNote").focus();
                    delMed(id);
                    return;
                }
                count++;
            })
         }

         function delMed(id){
            medicines = medicines.filter(function (el) {
            return el != null;
            });
            console.log(id);
            count=0;
            medicines.forEach(element=>{
                if(element.id==id){
                    delete medicines[count];
                    medTableUpdate();
                    return;
                }
                count++;
            })
         }

            
            var states = [
                @foreach($medicines as $med)
                    '{{ucWords($med->name_english)}}',
                @endforeach
            ];
        
            var states = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                // `states` is an array of state names defined in "The Basics"
                local: states
            });

      
    
            $('#bloodhound #medSearch').typeahead({
                hint: true,
                highlight: true,
                minLength: 2
            }, {
                name: 'states',
                source: states
            });
    
            $('#medSearch').bind('typeahead:select', function(ev, suggestion) {
                $("#medNote").removeAttr("disabled");
                $("#medNote").focus();
                // 

            });
    </script>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="box mt-2 box-dark">
            <div class="box-header with-border">
                <p class="h4 m-0">Patient Diagnosis</p>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="box-body">
                        <div class="form-group">
                            <textarea class="form-control text-capitalize" name="diagnosys" id="diagnosys" cols="73"
                                rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 pl-5 pr-5">
                    <label class="mt-3" for="">Blood Pressure</label>
                    <div class="input-group">
                        <input id="pressure" name="pressure" type="text" class="form-control">
                        <span class="input-group-addon">mmHg</span>
                    </div>
                    <label class="mt-3" for="">Blood Glucose Level</label>
                    <div class="input-group">
                        <input id="glucose" type="text" class="form-control">
                        <span class="input-group-addon">mg/dL</span>
                    </div>
                    <label class="mt-3" for="">General Cholestrol Level</label>
                    <div class="input-group">
                        <input id="cholestrol" type="text" class="form-control">
                        <span class="input-group-addon">mg/dL</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="p-2 mt-5 ml-1 mr-1">
                        <button type="button" onclick="submit()" class="btn btn-block btn-success btn-lg">Save &
                            Next</button>
                        <br>
                        @if ($inpatient=="YES")
                        <button disabled type="button" class="btn btn-block btn-primary btn-lg">Inpatient</button>
                        @endif

                        @if ($inpatient=="NO")
                        <button id="admit-btn" type="button" onclick="admitPatient('YES')"
                            class="btn btn-block btn-warning btn-lg">Admit Patient</button>
                        @endif

                        <br>
                        <button type="button" onclick="clearAll()"
                            class="btn btn-block btn-danger btn-lg">Clear</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    var inpatient='{{$inpatient}}';
    function admitPatient(status){
        bootbox.confirm({
            title:"<h2>Confirm Admit Patient</h2>",
            message: "<p>This Will Make This Patient(Out Patient) an Inpatient.<br>Press Admit Patient To Admit The Patient.<br>Note:This Action Cannot Be Undone.</p>",
            buttons: {
                confirm: {
                    label: 'Admit Patient',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result){
                    var data=new FormData;
                    data.append('_token','{{csrf_token()}}');
                    data.append('admit',status);
                    data.append('pid',{{$pid}});
                    data.append('app_num',{{$appNum}});
                    $.ajax({
                        type: "POST",
                        url: "{{route('markInPatient')}}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data:data,
                        success: function (response) {
                            console.log('success');
                            console.log(response);
                            if(response.success){
                                $("#admit-btn").attr('disabled','disabled');
                                $("#admit-btn").text("Patient Admitted");
                                $("#admit-btn").removeClass('btn-warning');
                                $("#admit-btn").addClass('btn-primary');
                            }else{
                                $("#admit-btn").attr('disabled','disabled');
                                $("#admit-btn").text("Error Occured");
                                $("#admit-btn").removeClass('btn-warning');
                                $("#admit-btn").addClass('btn-danger');
                            }
                        },
                        error: function(data){
                            console.log('error occured');
                            console.log(data);
                            $("#admit-btn").attr('disabled','disabled');
                            $("#admit-btn").text("Error Occured");
                            $("#admit-btn").removeClass('btn-warning');
                            $("#admit-btn").addClass('btn-danger');
                            bootbox.alert({
                                title:"Error Occured On Admit Patient",
                                message: "Error Occured! Try Later."+data,
                                backdrop: true
                            });
                        },
                    });
                }
            }
        });
        
    }

    function validate(){
        var diag=$('textarea').val();
        var pressure=/^([0-9]{3}|[0-9]{2})[/]([0-9]{3}|[0-9]{2})$/.test($('#pressure').val());
        var cholestrol=/^[0-9]{2}|[0-9]{3}$/.test($('#cholestrol').val());
        var glucose=/^[0-9]{2}|[0-9]{3}$/.test($('#glucose').val());
        if(diag.length<5){
            $('textarea').addClass('border-danger');
            diag=false;
        }else{
            $('textarea').removeClass('border-danger');
            diag=true;
        }
        if($('#pressure').val()==""){
            pressure=true;
           
        }
        if($('#cholestrol').val()==""){
            cholestrol=true;
        }
        if($('#glucose').val()==""){
            glucose=true;   
        }

        if(cholestrol){
            $('#cholestrol').removeClass('border-danger');
        }else{
            $('#cholestrol').addClass('border-danger');
        }

        if(glucose){
            $('#glucose').removeClass('border-danger');
        }else{
            $('#glucose').addClass('border-danger');
        }

        if(pressure){
            $('#pressure').removeClass('border-danger');
        }else{
            $('#pressure').addClass('border-danger');
        }

        if(pressure && cholestrol && glucose && diag){
            return true;
        }else{
            return false;
        }
    }

    function submit(){
        if(!validate()){
            return;
        }else{
            bootbox.confirm({
            title:"<h2>Done Channelling</h2>",
            message: "<p>This will finish the chanelling for the patient.<br>No changes can be done to the prescription after saving.<br>Please check your actoin before comfirm.<br>Note:This Action Cannot Be Undone.</p>",
            buttons: {
                confirm: {
                    label: 'Confirm Save',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback:function(result){
                if (result) {
                    window.scrollTo(0,0);
        var diag=$('textarea').val();
        var pressure=$('#pressure').val();
        var cholestrol=$('#cholestrol').val();
        var glucose=$('#glucose').val();
        var data={
            _token:'{{csrf_token()}}',
            patient_id:patient_id,
            appointment_num:app_num,
            appointment_id:{{$appID}},
            medicines:medicines,
            diagnosis:diag,
            pressure:pressure,
            glucose:glucose,
            cholestrol:cholestrol,
        };
        $.ajax({
            type: "POST",
            url: "{{route('checkSave')}}",
            processData: false,
            contentType: "application/json",
            cache: false,
            data:JSON.stringify(data),
            success: function (response) {
                if(response==200){
                    clearAll();
                    window.location.replace("{{route('check_patient_view')}}");
                }
            },
            error: function(response){
                bootbox.alert({
                    title:"Error Occured On Save",
                    message: "Error Occured! Try Later."+response,
                    backdrop: true
                });
            },
        });

        };
       
    }
    });
    }
    }

    function clearAll(){
        medicines=[];
        medTableUpdate();
        sessionStorage.clear();
        $('input').val("");
        $('textarea').val("");
    }
</script>

@endsection

@section('custom_styles')
.typeahead,
.tt-query,
.tt-hint {
width: 100%;
height: 100%;
{{-- padding: 8px 12px; --}}
{{-- font-size: 24px; --}}
{{-- line-height: 30px; --}}
border: 2px solid #ccc;
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
outline: none;
}

.typeahead {
background-color: #fff;
}

.typeahead:focus {
border: 2px solid #0097cf;
}

.tt-query {
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
color: #999
}

.tt-menu {
width:100% ;
margin: 3px 0;
padding: 8px 0;
background-color: #fef;
border: 1px solid #ccc;
border: 1px solid rgba(0, 0, 0, 0.2);
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
-webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
-moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
padding: 3px 20px;
font-size: 15px;
line-height: 20px;
}

.tt-suggestion:hover {
cursor: pointer;
color: #fff;
background-color: #0097cf;
}

.tt-suggestion.tt-cursor {
color: #fff;
background-color: #0097cf;

}

.tt-suggestion p {
margin: 0;
}

@endsection