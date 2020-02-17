@foreach ($prescs as $presc)
<br>----------------------
<br>
{{$presc->patient->name}}

<br>{{$presc->patient->id}}
<br>{{$presc->diagnosis}}

    @php
        
        $pres_med=json_decode($presc->medicines);
        $bp=json_decode($presc->bp);
        $cholestrol=json_decode($presc->cholestrol);
        $sugar=json_decode($presc->blood_sugar);
    @endphp

    <p>Cholestrol : {{$cholestrol->value}}<small>(Updated {{$cholestrol->updated}})</small></p>
    <p>Blood Sugar : {{$sugar->value}}<small>(Updated {{$sugar->updated}})</small></p>
    <p>Blood Pressure : {{$bp->value}}<small>(Updated {{$bp->updated}})</small></p>

    @foreach($pres_med as $med)
        <ul>
            <li>{{ucwords($med->name)}}</li>
            <ul>
                <li>
                    {{$med->note}}
                </li>
            </ul>
        </ul>
    @endforeach
<br>----------------------
@endforeach