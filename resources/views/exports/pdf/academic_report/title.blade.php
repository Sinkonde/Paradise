@section('title')
<div style="text-align:center">

    {{-- <img src="{{public_path('img/logo3.png')}}" alt="" srcset="" class="" style="width:50px; margin-bottom:10px"> --}}
    <p class="font-semibold" style="font-size:12px; padding-bottom:3px; margin:0px; line-height:;font-weight:300">THE SHINING</p>
    <p style="font-size:14px; margin:0px;">NURSERY AND PRIMARY ENGLISH MEDIUM SCHOOL</p>
    <p style="font-size:18px; margin-top:8px; margin-bottom:0px"><b>TAARIFA YA MAENDELEO YA TAALUMA YA MWANAFUNZI</b></p>
    <p style="font-size:16px; padding-bottom:0px; padding-top:0px; margin-top:0">{{strtoupper($report->name)}}, {{strtoupper(setCustomDate($report->main_exam->date, false))}} - {{date('Y', strtotime($report->main_exam->date))}}</p>
</div>
@endsection
