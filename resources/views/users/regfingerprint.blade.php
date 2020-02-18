@extends('template.main')

@section('title', $title)

@section('content_title',__($title))
@section('content_description',__("Register New Fingerprint For A New User"))

@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:1vh;padding:3%" class="row">
    <div class="col-md-2"></div>
    <div class="mt-5 col-md-8 mx-auto">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session()->get('success')}}
        </div>
        @endif
        @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>

            {{session()->get('fail')}}
        </div>
        @endif

        <div class="mt-5 box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Register Fingerprint')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{route('user.regfinger')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="userid" class="col-sm-2 control-label">{{__('User ID')}} <span class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <input type="number" name="userid"
                                class="form-control @error('userid') border border-danger @enderror" id="userid"
                                value="{{ old('userid') }}" placeholder="User ID">
                            @error('userid')
                            <span class="text-danger text-capitalize invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fingerid" class="col-sm-2 control-label">{{__('Fingerprint ID')}} <span class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <input type="number" name="fingerid"
                                class="form-control @error('fingerid') border border-danger @enderror"
                                value="{{ old('fingerid') }}" id="fingerid" placeholder="Fingerprint ID">
                            @error('fingerid')
                            <span class="text-danger text-capitalize invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">{{__('Register')}}</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>



@endsection