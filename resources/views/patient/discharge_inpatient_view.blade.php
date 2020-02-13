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

{{-- <div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else
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

</div> --}}

<div class="box box-info" id="reginpatient5">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Medical Officer - Abstract of Case')}}</h3>
    </div>

    <form class="form-horizontal">
        <div class="box-body">

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Description:')}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reg_medicalofficer1" rows="3" cols="100"
                        placeholder="Enter abstract condition of patient here"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">{{__('Date of Discharge/Death')}}</label>
                <div class="col-sm-2">
                    <input type="date" onload="getDate()" class="form-control" name="reg_medicalofficer2">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Diagnosis')}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="reg_medicalofficer3" rows="3" cols="100"
                        placeholder="Enter abstract diagnosis of patient here"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">{{__('Certified by')}}</label>
                <div class="col-sm-10" id="al-box">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Select Your ID here" />
                </div>
            </div>


        </div>
        <!-- /.box-body -->

    </form>

    <div class="box-footer">
        <input type="submit" class="btn btn-info pull-right" value="Submit">
        <input type="reset" class="btn btn-default" value="Cancel">
    </div>
    <!-- /.box-footer -->


</div>

@endsection