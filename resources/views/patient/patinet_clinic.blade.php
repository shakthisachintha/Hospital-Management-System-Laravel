@foreach ($clinics as $clinic)
@php
$flag=0;
@endphp
@foreach($assinged_clinics as $key)
@if($clinic->id==$key->id)
@php
$flag=1;
@endphp
@endif
@endforeach
@if ($flag==0)
<option value={{$clinic->id}}>{{$clinic->name_eng}}({{$clinic->name_sin}})</option>
@endif
@endforeach