@section('title')
<div style="text-align:center; padding-bottom:50px; heght:100%; background-color:#ddd">
    <img src="{{public_path('img/logo3.png')}}" alt="" srcset="" class="" style="width:100px; margin-bottom:100px">
    <p class="font-semibold" style="font-size:12px; padding-bottom:3px; margin:0px; line-height:;font-weight:300">THE SHINING</p>
    <p style="font-size:16px; padding-bottom:3px; margin:0px;">NURSERY AND PRIMARY ENGLISH MEDIUM SCHOOL</p>

    <p style="font-size:18px; padding-top:3px; margin:0px;"><b>CLASS ACADEMIC RESULTS ANALYSIS</b></p>
    <table style="position: absolute; bottom:0px; width:100%">
        <tr>
            @inject('members', 'App\Models\ClassMember')
            @php
                $student = key(array_slice($results['results'],0,1));
                $class = $members->find($student)->class;
            @endphp
            <td>CLASS {{strtoupper($class->grade->name.'-'.$class->stream->name)}}</td>
            <td style="text-align: right">MARCH 2021</td>
        </tr>
    </table>
</div>
@endsection
