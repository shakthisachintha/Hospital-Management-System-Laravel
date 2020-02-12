@extends('template.main')

@section('title', $title)

@section('content_title',"Wards")
@section('content_description',"Ward Management")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:1vh;padding:3%" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
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
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add New Ward</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form method="POST" action="{{route('add-ward')}}" class="form-horizontal">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="ward_num">{{__('Ward Number')}}</label>

                        <div class="col-sm-10">
                            <input class="form-control" name="ward_num" required id="ward_num" type="number"
                                placeholder="Ward Number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="total_beds">{{__('Total Beds')}}</label>

                        <div class="col-sm-10">
                            <input class="form-control" name="total_beds" id="total_beds" type="number"
                                placeholder="Total Beds">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="free_beds">{{__('Free Beds')}}</label>

                        <div class="col-sm-10">
                            <input class="form-control" name="free_beds" id="free_beds" type="number"
                                placeholder="Free Beds">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="doctor">{{__('Free Beds')}}</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="doctor" id="doctor">
                                @foreach ($docs as $doctor)
                                <option value="{{$doctor->id}}">Dr. {{ucWords($doctor->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" type="reset">Cancel</button>
                    <button class="btn btn-info pull-right" type="submit">Add Ward</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

@endsection