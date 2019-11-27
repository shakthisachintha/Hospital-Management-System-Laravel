@extends('template.main')

@section('title', $title)

@section('content_title',"More Attendance")
@section('content_description',"Get Detailed Reports Of Attendance Of All Users")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
<script src="https://code.jscharting.com/latest/jscharting.js"></script>


@endsection