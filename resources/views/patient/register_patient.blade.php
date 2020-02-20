@extends('template.main')

@section('title', $title)

@section('content_title',__('Patient Registration'))

@section('content_description',__("Register New Out Patients Here"))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  patient registration  --}}

<script src="/js/WebCam/webcam.js"></script>

<div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else
    style="margin-bottom:0;margin-top:8vh" @endif class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if (session()->has('regpsuccess'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <button
                onclick="window.open('{{route('pregcard',session()->get('pid'))}}','myWin','scrollbars=yes,width=830,height=500,location=no').focus();"
                class="btn btn-warning ml-5"><i class="fas fa-print"></i> Print Registration Card </button>
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

<div class="row">
    <!-- right column -->
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Patient Registration Form')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{ route('patient_register') }}" class="form-horizontal">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}} <span
                                style="color:red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" minlength="10" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"
                                required class="form-control" name="reg_pname" placeholder="Enter Patient Full Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{__('NIC Number')}}</label>
                        <div class="col-sm-10">
                            <input type="text" pattern="^[1-9]{1}[0-9]{8}[V,X,v,x]|[0-9]{12}$" maxlength="12"
                                class="form-control" name="reg_pnic" placeholder="National Identity Card Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Address')}} <span
                                style="color:red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" name="reg_paddress"
                                placeholder="Enter Patient Address ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Telephone')}} <span
                                style="color:red">*</span></label>
                        <div class="col-sm-10">
                            <input pattern="\+[0-9]{11}|[0-9]{10}" required maxlength="12" type="text"
                                class="form-control" name="reg_ptel" placeholder="Patient Telephone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Occupation')}} <span
                                style="color:red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" name="reg_poccupation"
                                placeholder="Enter Patient Occupation ">
                        </div>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Sex')}}<span style="color:red">*</span></label>
                        <div class="col-sm-2 mr-0 pr-0">
                            <select required class="form-control" name="reg_psex">
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <label class="col-sm-1 control-label">{{__('DOB')}}<span style="color:red">*</span></label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" required max="2014-12-30" class="form-control pull-right"
                                    name="reg_pbd" placeholder="Birthday">
                            </div>

                        </div>


                        <label for="photo" class="col-sm-1 control-label">{{__('Picture')}}</label>
                        <div class="col-sm-2">
                            <button id="photo_btn" type="button" onclick="camStart();" data-toggle="modal"
                                data-target="#modal-default" class="bg-navy btn btn-flat"><i class="fas fa-camera"></i>
                                <span id="photo_btn_text">{{__('Take a Photo')}}</span> <i id="photo_icon"
                                    style="display:none;" class="far text-dark fa-check-circle"></i> </button>

                            <input type="text" style="display:none" id="regp_photo" name="regp_photo">
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="submit" class="btn btn-info pull-right" value="{{__('Register')}}">
                        <input type="reset" class="btn btn-default" value="{{__('Cancel')}}">
                    </div>
                    <!-- /.box-footer -->
                </div>
            </form>

            <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

            <script>
                $('#datepicker').datepicker({
                autoclose: true
            });

            function camStart(){
                Webcam.set({
                width: 200,
                height: 150,
                image_format: 'png',
                jpeg_quality: 100
                });
                Webcam.attach( '#my_camera' );
            }

            var data;

            function takeSnapshot() {
                Webcam.snap( function(data_uri) {
                    data=data_uri;
                    document.getElementById('results').innerHTML ='<img style="width:200px;height:150px" src="'+data_uri+'"/>';
                    $("#save_btn").removeAttr("disabled");
                });
            }

            function saveSnap(){
                document.getElementById('regp_photo').setAttribute("value", data);
                $("#photo_icon").fadeIn();
                $("#photo_btn").addClass("btn-success");
                $("#photo_btn_text").text("{{__('Photo Taken')}}");
                $("#photo_btn").removeClass("bg-navy");
                Webcam.reset();
            }

            function cancelSnap(){
                document.getElementById('regp_photo').removeAttribute("value");
                $("#photo_icon").fadeOut();
                $("#photo_btn").removeClass("btn-success");
                $("#photo_btn").addClass("bg-navy");
                if(data==null){
                    $("#save_btn").attr("disabled", "disabled");
                }
                Webcam.reset();
            }

            </script>



            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="Webcam.reset()"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{__('Take The Photo')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-5 mr-3">
                                    <h4>{{__('Live Preview')}}</h4>
                                    <div c>
                                        <div id="my_camera"></div>
                                    </div>
                                    <input type="button" class="btn mt-1 btn-flat btn-success" value="Take Snapshot"
                                        onClick="takeSnapshot();">
                                </div>
                                <div class="col-sm-5">
                                    <h4>{{__('Image Taken')}}</h4>
                                    <div id="results">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" onclick="cancelSnap();"
                                data-dismiss="modal">{{__('Cancel')}}</button>
                            <button id="save_btn" type="button" disabled class="btn btn-primary" data-dismiss="modal"
                                onclick="saveSnap();">{{__('Save Changes')}}</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </div>
    </div>
    <div class="col-md-1"></div>
</div>

@endsection
