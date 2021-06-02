@section('result_footer')
<div style="padding:20px 0px">
    <b style="margin-top:15px">B: MALIPO</b>
    <p style="line-height: 4px"><i>Tazama fomu iliyoambatanishwa!</i></p>
</div>

<div style="padding-bottom:20px">
    <b style="margin-bottom:2px">C: MAELEZO MUHIMU</b>
    <ol type="1" style="line-height: 25px">
        <li>Shule imefungwa siku ya <b>{{setCustomDate($report->closing_date)}}</b> tarehe <b>{{date('d', strtotime($report->closing_date))}} {{setCustomDate($report->closing_date, false)}}</b>, mwaka  <b>{{date('Y', strtotime($report->closing_date))}}</b></li>
        {{-- <li>Wanafunzi wa <b>bweni</b> watafungua siku ya <b>{{setCustomDate($report->board_open)}}</b> ya tarehe <b>{{date('d', strtotime($report->board_open))}} {{setCustomDate($report->board_open, false)}}</b>, mwaka  <b>{{date('Y', strtotime($report->board_open))}}</b></li> --}}
        <li>Shule itafunguliwa siku ya <b>{{setCustomDate($report->day_open)}}</b> ya tarehe <b>{{date('d', strtotime($report->day_open))}} {{setCustomDate($report->day_open, false)}}</b>, mwaka  <b>{{date('Y', strtotime($report->day_open))}}</b></li>
        {{-- <li>Vyombo vya kulia chakula (yaani sahani, kikombe na kijiko), vyote kwa pamoja vinapatikana shuleni kwa jumla ya gharama ya shilingi elfu tatu (3000/=) tu.</li> --}}
    </ol>
</div>

<i>Kata kipande hiki na ukirudishe shuleni pindi inapofunguliwa</i>
<div style="width:100%; border-top:1px dotted black; padding-top:30px">
Maoni ya Mzazi/Mlezi:
</div>
@endsection
