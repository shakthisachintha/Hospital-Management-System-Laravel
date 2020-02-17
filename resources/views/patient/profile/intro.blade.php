@extends('template.main')

@section('title', $title)

@section('content_title',__("Patient Profile"))
@section('content_description',"")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection
@section('main_content')


<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box box-success mt-5">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Patient Profile')}}</h3>
            </div>
            <div class="box-body">
                <form class="pl-5 pr-5 pb-5" method="get" action="{{route('patientProfileIntro')}}">
                    @csrf
                    <h3>{{__('Enter Patient Registration Number')}}</h3>
                    <input name="pid" id="pid" class="form-control input-lg" type="number" placeholder="Patient Registration Number">
                    <input id="btn_submit" type="submit" class="btn btn-primary btn-lg mt-3 text-center"
                        value={{__("View Profile")}}>
                </form>
            </div>
        </div>
        @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> {{_('Invalid Registration Number!')}}</h4>

            {{session()->get('fail')}}
        </div>
        @endif
    </div>
    <div class="col-md-1"></div>

</div>

@endsection