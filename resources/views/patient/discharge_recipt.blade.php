@php
use App\Inpatient;
use App\Patients;

@endphp
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<style>
    @media print
{    
.no-print, .no-print *
{
    display: none !important;
}
}
</style>
<title>Print Discharge Recipt</title>
</head>
<body>

<div class="box box-info">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="box-header with-border">
            <h2 class="text-center text-upppercase">
                AYRUVEDA HOSPITAL KESBAWA<br>
                <small class="small">Discharge Reciept</small>
            </h2>
            <br>
            Patient Name: {{Patients::find($INPtableUpdate->patient_id)->name}}<br>
            Patient ID: {{Patients::find($INPtableUpdate->patient_id)->id}}<br>
            Prescribed By: Dr.{{$INPtableUpdate->approved_doctor}}<br>
            <br>
            <br>
            <div>
            <h5>Discharged Date : {{$INPtableUpdate->discharged_date}}</h5>
            <h5>Discription : {{$INPtableUpdate->description}}</h5>
            <h5>Issued by : {{ucwords(Auth::user()->name)}}</h5>
            </div>
            <button onclick="window.print()" class="btn no-print btn-lg btn-info">Print <i class="fas fa-print"></i></button>
            <a href="{{route('discharge_inpatient')}}" class="btn btn-dark btn-lg no-print">Go Back</a>
        </div>

        <div class="col-md-3"></div>
    </div>
</div>

</body>
</html>