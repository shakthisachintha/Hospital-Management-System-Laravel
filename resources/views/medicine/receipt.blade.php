



@php
    use App\Medicine;
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
    <title>Print Prescrition | {{$presc->id}}</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-center text-upppercase">
                    AYRUVEDA HOSPITAL KESBAWA<br>
                    <small class="small">Medicine Reciept</small>
                </h3>
                Patient Name: {{$presc->patient->name}}<br>
                Patient ID: {{$presc->patient->id}}<br>
                Prescribed By: Dr.{{ucwords($presc->doctor->name)}}

                <table class="mt-4 w-100">
                    <colgroup>
                        <col style="width: 50%" />
                        <col style="width: 50%" />
                       
                      </colgroup>
                    @foreach ($medicines as $med)
                        <tr>
                            <td>{{Medicine::find($med->medicine_id)->name_sinhala}}</td>
                            <td>{{$med->note}}</td>
                        </tr>
                    @endforeach
                </table>
                <br>
                Date of Issue: {{explode(" ",$presc->created_at)[0]}}<br>
                Issued By: {{ucwords(Auth::user()->name)}}
                <p class="mt-5 small text-center">This Is An Automated Computer Generated Slip</p>
                
                <button onclick="window.print()" class="btn no-print btn-lg btn-info">Print <i class="fas fa-print"></i></button>
                <a href="{{route('issueMedicineView')}}" class="btn btn-dark btn-lg no-print">Go Back</a>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>

  </body>
</html>