@extends('template.main')

@section('title', $title)

@section('sidebar')

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
        </ul>
    </li>
    {{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Channel</span></a>
    </li>
    {{--check patient--}}
    <li class="active"><a href="{{route('check_patient_view')}}"><i class="fas fa-procedures"></i><span> Check Patient</span></a></li>
    
    {{--register in patient--}}
    <li><a href="{{route('register_in_patient_view')}}"><i class="fas fa-user-plus"></i><span> Register In Patient</span></a></li>
    
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
<div class="row">
    <div class="rounded col-md-5">
        <h4>Channel Details</h4>
        <div class="input-group">
            <input type="text" placeholder="Appointment Number" class="form-control">
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat">Check &nbsp; <i
                        class="fas fa-sync-alt"></i></button>
            </span>
        </div>
        <div style="margin-bottom:0" class="box box-dark mt-2">
            <div class="box-header with-border">
                Add Medicines To Prescription
            </div>
            <div class="box-body">
                <div class="row mb-2">
                    <div class="col-xs-5">
                        <input type="text" class="form-control" placeholder="Type To Search Medicine">
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" placeholder="Dosage">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Notes">
                    </div>
                </div>

                <div style="height:30vh;overflow-y: scroll">
                    <table class="table table-sm table-bordered w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Medicine</th>
                                <th>Dosage</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dasamulaarishtaya</td>
                                <td>2/3/12</td>
                                <td>No Notes</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bee Honey</td>
                                <td>2/3/12</td>
                                <td>No Notes</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Polpala Pulp</td>
                                <td>3/3/12</td>
                                <td>No Notes</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Niyagala Ala</td>
                                <td>1/3/12</td>
                                <td>No Notes</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Walas Oil</td>
                                <td>2/3/12</td>
                                <td>No Notes</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Dasamulaarishtaya</td>
                                <td>2/3/12</td>
                                <td>No Notes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

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
                                <h5>Name : John Doe</h5>
                                <h5>Age & Sex : 35 Male</h5>
                                <h5>Blood Pressure : <span class="h4 text-yellow">138/94 mmHg</span><small> (Updated
                                        14-08-2019)</small></h5>
                                <h5>Blood Glucose Levels : <span class="h4 text-green">85 mg/dL</span><small> (Updated
                                        14-08-2019)</small></h5>
                                <h5>General Cholestrol Level : <span class="h4 text-red">239 mg/dL</span><small>
                                        (Updated 14-08-2019)</small></h5>

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
