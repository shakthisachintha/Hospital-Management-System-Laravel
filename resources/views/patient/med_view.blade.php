@extends('template.main')

@section('title', $title)

@section('content_title',"Pharamacy")
@section('content_description',"Issue Medicines here.")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  issue medicine  --}}




<div class="col-xs-12" id="issuemedicine3" >
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Prescription</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" style="text-align:center;font-size:18px">Medicine</th>
                        <th scope="col" style="text-align:center;vertical-align:middle;font-size:18px" rowspan="2">Note
                        </th>
                        <th scope="col" style="text-align:center;vertical-align:middle;font-size:18px" rowspan="2">
                            Issued or Not</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;font-size:15px">English</th>
                        <th style="text-align:center;font-size:15px">Sinhala</th>
                    </tr>
                </thead>
                <tbody id="bodyData">
                    @foreach ($data as $med)
            <tr>
                <td>{{ $med->e }}</td>
                    <td>{{ $med->s }}</td>
                    <td>{{ $med->n }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ csrf_field() }}
    </div>
</div>
</div>



@endsection