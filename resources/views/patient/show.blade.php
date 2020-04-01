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
@php
use App\Medicine;
use App\Prescription_Medicine;

@endphp
@section('main_content')
{{--  issue medicine  --}}




<div class="col-xs-12" id="issuemedicine3">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Prescription</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-active">
                <thead>
                    <tr>
                        
                        <th scope="col" colspan="3" style="text-align:center;font-size:18px">Medicine</th>
                        <th scope="col" style="text-align:center;vertical-align:middle;font-size:18px" rowspan="2">Note
                        </th>
                        <th scope="col" style="text-align:center;vertical-align:middle;font-size:18px" rowspan="2">
                            Issued or Not</th>
                    </tr>
                    <tr>
                        <th>Medicine ID</th>
                        <th style="text-align:center;font-size:18px">English</th>
                        <th style="text-align:center;font-size:18px">Sinhala</th>
                    </tr>
                </thead>
                <tbody id="bodyData">
                    @foreach ($pmedicines as $med)
                    <tr>
                        <td>
                            {{$med->medicine_id}}
                        </td>
                        <td style="text-align:center;font-size:15px;">
                            {{ ucwords(Medicine::find($med->medicine_id)->name_english) }}</td>
                        <td style="text-align:center;font-size:15px;">
                            {{ Medicine::find($med->medicine_id)->name_sinhala }}</td>
                        <td style="text-align:center;font-size:15px;">{{ $med->note }}</td>
                        <td id="td-issue-{{$med->id}}" style="text-align:center;">
                            @if ($med->issued=="YES")
                            <span style="font-size:14px" class="badge bg-green"><i class="fas fa-check"></i> Issued
                            </span>
                            @else
                            <button style="font-size:18px;" id="btn-issue-{{$med->id}}"
                                onclick="issueMedicine('{{$med->id}}')" class='btn bg-navy btn-lg'>Issue</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

<div class="box box-info">
    <div class="box-header with-border">
    <div class="form-group">
        <h3>Number of Medicine Types Issued Now</h3>
        <input type="text" id="medCount" readonly class="col-sm-2 form-control" value="{{Prescription_Medicine::where('prescription_id',$presid)->select('medicine_id')->count('medicine_id')}}">
    </div>
<br>
    <div class="form-group">
        <h3>Quantity of Each Medicine Issued Up To Now</h3>
        {{-- for="medDisplay" class="col-sm-2"> --}}
        <table class="table table-striped table-bordered">
            <tbody>
        @foreach ($pmedicines as $med)
        <tr>
            {{-- <td>
                {{$med->medicine_id}}
            </td> --}}
            <td style="text-align:left;font-size:15px;">
                {{ Medicine::find($med->medicine_id)->name_sinhala }}</td>
            <td style="text-align:left;font-size:15px;">
                {{ Medicine::find($med->medicine_id)->qty }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
</div>
</div>

            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <form action="{{route('medIssueSave')}}" method="get">
                        <input type="hidden" name="presid" id="presid" value="{{$presid}}">
                        @if ($prescription->medicine_issued=="YES")
                       
                        <input type="submit" id="btn-print" value="Print Receipt"
                        class="btn pull-right mt-5 mb-2 btn-lg btn-primary">
                        <p class="pull-left mt-5 pt-4">Note: This Prescription Is Already Marked As Issued</p>
                        
                        @else
                        <input type="submit" id="btn-print" value="Save & Print"
                        class="btn pull-right mt-5 mb-2 btn-lg btn-success">
                        @endif
                        
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>

<script>
    function savePrint(presid){

        var data=new FormData;
        data.append('medid',presid);
        data.append('_token','{{csrf_token()}}');

        $.ajax({
                type: "post",
                url: "{{route('medIssueSave')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                error: function(data){
                    console.log(data);
                },
                success: function (response) {
                  if(response.code==200){
                   $("#btn-print").attr("disabled", "disabled");

                  }
                }
        });
    }

    function issueMedicine(med_id){
        var data=new FormData;
        data.append('medid',med_id);
        data.append('_token','{{csrf_token()}}');

        $.ajax({
                type: "post",
                url: "{{route('markIssued')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                error: function(data){
                    console.log(data);
                },
                success: function (response) {
                  if(response.code==200){
                      $("#td-issue-"+med_id).html('<span style="font-size:14px" class="badge bg-green"><i class="fas fa-check"></i> Issued </span>');
                  }
                }
        });
    }
</script>

@endsection