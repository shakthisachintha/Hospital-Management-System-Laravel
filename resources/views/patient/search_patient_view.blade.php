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
<h3> NAME-: {{$patient->name}}<br>
    SEX-: {{$patient->sex}}<br>
    TELEPHONE-:{{$patient->telephone}}<br>
    ADDRESS-:{{$patient->address}}<br>
    OCCUPATION-:{{$patient->occupation}}<br>
    NIC-: {{$patient->nic}}<br>
    @endforeach
    @else
    No results found
    @endif
    @endif

    @endsection