@section('title')
<div class="uppercase" style="text-align:center;">
    <img src="{{public_path('img/logo.png')}}" alt="" srcset="" class="" style="width:50px; margin-bottom:10px">
    <p class="font-semibold" style="font-size:12px; padding-bottom:3px; margin:0px; line-height:;font-weight:300">{{strtoupper(config('app.name'))}}</p>
    <p style="font-size:16px; padding-bottom:3px; margin:0px;">{{strtoupper(env('app_desc'))}}</p>
</div>
@endsection
