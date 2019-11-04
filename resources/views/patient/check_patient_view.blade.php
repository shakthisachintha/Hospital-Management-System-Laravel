@extends('template.main')

@section('title', $title)

@section('sidebar')

@section('optional_scripts')
@endsection

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
                                        <input oninput="console.log(this.value);" id="medSearch" class="form-control" type="text" placeholder="Search Medicines">
                                    </div>
                                </div>
                                <div class="col-md-7 m-0 p-0">
                                    <input onkeydown="addMed(event,this)" id="medNote" disabled type="text" class="form-control" placeholder="Notes">
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

        function addMed(e,obj) { 
            var note=obj.value;
            var med=$("#medSearch").val();
            if(e.keyCode === 13){
                e.preventDefault(); 
                var med={name:med,note:note}
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
            $("#medTable tbody tr").remove();
            var count=1
             medicines.forEach(element => {
                $('#medTable > tbody:last-child').append('<tr><td>'+count+'</td><td>'+element.name+'</td><td>'+element.note+'</td><td><div class="btn-group"><button style="height:28px;" type="button" class="m-0 btn btn-danger btn-sm btn-flat"><i class="far fa-trash-alt"></i></button><button style="height:28px;" type="button" class="btn m-0 btn-warning btn-sm btn-flat"><i class="far fa-edit"></i></button></div></td></tr>');
                count++;
             });
         }

            
            var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
                'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
                'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
                'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
                'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
                'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
                'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
                'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
                'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
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
                console.log(suggestion);
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
                                <h5>Blood Pressure : <span class="h4 text-yellow">{{$pBloodPressure->sys}}/{{$pBloodPressure->dia}} mmHg</span><small> (Updated
                                    {{$pBloodPressure->date}})</small></h5>
                                <h5>Blood Glucose Levels : <span class="h4 text-green">{{$pBloodSugar->value}} mg/dL</span><small> (Updated
                                    {{$pBloodSugar->date}})</small></h5>
                                <h5>General Cholestrol Level : <span class="h4 text-red">{{$pCholestrol->value}} mg/dL</span><small>
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
                        <input id="pressure" name="pressure" type="text" class="form-control">
                        <span class="input-group-addon">mmHg</span>
                    </div>
                    <label class="mt-3" for="">Blood Glucose Level</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon">mg/dL</span>
                    </div>
                    <label class="mt-3" for="">General Cholestrol Level</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon">mg/dL</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="p-2 mt-5 ml-1 mr-1">
                            <button type="button" class="btn btn-block btn-success btn-lg">Save & Next</button>
                            <br>
                            <button type="button" class="btn btn-block btn-warning btn-lg">Mark As Inpatient</button>
                            <br>
                            <button type="button" class="btn btn-block btn-danger btn-lg">Clear</button>
                    </div>
                       
                </div>
            </div>

        </div>
    </div>

</div>

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