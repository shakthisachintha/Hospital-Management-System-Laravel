@extends('template.main')

@section('title', $title)

@section('content_title',"Dashboard")
@section('content_description',"Operate All The Things Here")
@section('breadcrumbs')
<ol class="breadcrumb">
    <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>

@endsection

@section('main_content')

<form action={{route('searchData')}} method="GET" role="search">
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" name="keyword" placeholder="Enter Patient"> <span
            class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>


    <input required checked type="radio" name="cat" id="cat" value="name"> Name
    <input required type="radio" name="cat" id="cat" value="telephone"> Telephone
    <input required type="radio" name="cat" id="cat" value="nic"> NIC

</form>

@if($search_result)
@if(!$search_result->isEmpty())

@foreach($search_result as $patient)
{{-- Search Results --}}
<div class="row">
    <!-- right column -->
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Search Results')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{__('Full Name')}}</label>
                        <div class="col-sm-10">
                            <input value="{{$patient->name}}" type="text" required class="form-control" name="reg_pname"
                                placeholder="Enter Patient Full Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{__('NIC Number')}}</label>
                        <div class="col-sm-10">
                            <input value="{{$patient->nic}}" type="text" required class="form-control" name="reg_pnic"
                                placeholder="National Identity Card Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Address')}}</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$patient->address}}" required class="form-control" name="reg_paddress"
                                placeholder="Enter Patient Address ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Telephone')}}</label>
                        <div class="col-sm-10">
                            <input value="{{$patient->telephone}}" type="tel" class="form-control" name="reg_ptel"
                                placeholder="Patient Telephone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{__('Occupation')}}</label>
                        <div class="col-sm-10">
                            <input value="{{$patient->occupation}}" type="text" required class="form-control" name="reg_poccupation"
                                placeholder="Enter Patient Occupation ">
                        </div>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Sex')}}</label>
                        <div class="col-sm-2 mr-0 pr-0">
                            <input value="{{$patient->sex}}" type="text" required class="form-control" name="reg_poccupation"
                                placeholder="Enter Patient Occupation ">
                        </div>

                        <label class="col-sm-2 control-label">{{__('DOB')}}<span style="color:red">*</span></label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input value="{{$patient->bod}}" type="text" class="form-control pull-right" name="reg_pbd"
                                    placeholder="Birthday">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
    @endforeach
    @else
    No results found
    @endif
    @endif



    @endsection