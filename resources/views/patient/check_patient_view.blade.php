@extends('template.main')

@section('title', $title)

@section('optional_scripts')
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
    function suggestMed(val){
    keyword=val;
    var data=new FormData;
    data.append('keyword',keyword);
    data.append('_token','{{csrf_token()}}');
    $.ajax({
        type: "POST",
        url: "{{route('medicineSuggests')}}",
        data:data,
        processData: false,
        contentType: false,
        cache: false,
        global:false,
        success: function (response) {
            console.log(response.sugestion)
            return(response)
        }
    });
}
</script>
<script src="js/typeahead/typeahead.bundle.js"></script>
{{-- <script src="js/typeahead/typeahead.jquery.js"></script> --}}
<script src="js/typeahead/bloodhound.js"></script>



<div class="row">

    <div class="rounded col-md-5">
        <h4>Channel Details</h4>
        <h4>Appointment Number : {{$appNum}}</h4>
        <div style="margin-bottom:0" class="box box-dark mt-2">
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
                console.log("Found");
                }else{
                console.log("not found");
                return;
                }
            }
            sessionStorage.setItem('app',{{$appNum}});
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

    <div class="col-md-7">
        <h4 class="text-center">Patient's Details And Treatment History</h4>
        <div style="height:46.5vh;overflow-y:scroll;" class="p-2 box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class="fas fa-notes-medical"></i>&nbsp;Patient's Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                    aria-expanded="false" class="collapsed">
                                    Patient's Details <small>(Updated 14-08-2019)</small>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="box-body">
                                <h5>Name : {{$pName}}</h5>
                                <h5>Age & Sex : {{$pAge}} {{$pSex}}</h5>
                                <h5>Blood Pressure : <span
                                        class="h4 text-yellow">{{$pBloodPressure->sys}}/{{$pBloodPressure->dia}}
                                        mmHg</span><small> (Updated
                                        {{$pBloodPressure->date}})</small></h5>
                                <h5>Blood Glucose Levels : <span class="h4 text-green">{{$pBloodSugar->value}}
                                        mg/dL</span><small> (Updated
                                        {{$pBloodSugar->date}})</small></h5>
                                <h5>General Cholestrol Level : <span class="h4 text-red">{{$pCholestrol->value}}
                                        mg/dL</span><small>
                                        (Updated {{$pCholestrol->date}})</small></h5>

                            </div>
                        </div>
                    </div>
                    <div class="mt-2 pl-0 mb-2 box-header with-border">
                        <h3 class="box-title"><i class="fas fa-file-medical"></i>&nbsp;Patient's Treatment History</h3>
                    </div>
                    <div class="panel box box-warning">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed"
                                    aria-expanded="false">
                                    <i class="fas fa-history"></i> &nbsp; 14-08-2019
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false"
                            style="height: 0px;">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                    class="collapsed" aria-expanded="false">
                                    <i class="fas fa-history"></i> &nbsp; 10-07-2019
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false"
                            style="height: 0px;">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                                    class="collapsed" aria-expanded="false">
                                    <i class="fas fa-history"></i> &nbsp; 17-06-2019
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false"
                            style="height: 0px;">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                                    class="collapsed" aria-expanded="false">
                                    <i class="fas fa-history"></i> &nbsp; 12-05-2019
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false"
                            style="height: 0px;">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>

                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed"
                                    aria-expanded="false">
                                    <i class="fas fa-history"></i> &nbsp; 17-04-2019
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false"
                            style="height: 0px;">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"
                                    class="collapsed" aria-expanded="false">
                                    <i class="fas fa-history"></i> &nbsp; 22-03-2019
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSeven" class="panel-collapse collapse" aria-expanded="false"
                            style="height: 0px;">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box-body -->
    </div>
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
                <div class="col-md-5">
                    <label class="mt-3" for="">Blood Pressure</label>
                    <div class="input-group">
                        <input id="pressure" pattern="/([0-9]{3}|[0-9]{2})[/]([0-9]{3}|[0-9]{2})/g" name="pressure" type="text" class="form-control">
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
                        <button type="button" onclick="submit()" class="btn btn-block btn-success btn-lg">Save & Next</button>
                        <br>
                        @if ($inpatient=="YES")
                        <button disabled type="button"
                            class="btn btn-block btn-primary btn-lg">Inpatient</button>
                        @endif

                        @if ($inpatient=="NO")
                        <button type="button" onclick="admitPatient('YES')" class="btn btn-block btn-warning btn-lg">Mark As
                            Inpatient</button>
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
            },
            error: function(data){
                console.log('error occured');
                console.log(data);
            },
        });
    }

    function submit(){
        var diag=$('textarea').val();
        var pressure=$('#pressure').val();
        var cholestrol=$('#cholestrol').val();
        var glucose=$('#glucose').val();
        var data={
            patient_id:patient_id,
            appointment_num:app_num,
            medicines:medicines,
            diagnosis:diag,
            pressure:pressure,
            glucose:glucose,
            cholestrol:cholestrol,
        };
        console.log(data);
    }

    function clearAll(){
        medicines=[];
        medTableUpdate();
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