@include('exports.pdf.class.title')
@section('members')

<div>
    @yield('title')
    <div>
        <p class="text-lg font-thin" style="font-weight: 200; font-size:1.125rem; text-align:center">
            @if (count($class->members))
                ALL MEMBERS OF CLASS {{$class->grade->name.' '.$class->stream->name}} - ({{$class->academic_year->year}})
            @else
                No any member so far!
            @endif
        </p>
    </div>
    @if (count($class->members))
    <table style="width:100%; border-collapse:collapse; font-size:0.875rem">
        <thead>
            <tr style="background-color: #e5e7eb; padding-top:0.5rem; padding-bottom:0.5rem">
                <th style="padding-top:0.5rem; padding-bottom:0.5rem; border-bottom: 1px solid #666">SN</th>
                <th style="padding-top:0.5rem; padding-bottom:0.5rem; text-align:left; border-bottom: 1px solid #666">NAME</th>
                <th style="text-align:center;  border-bottom: 1px solid #666; padding-top:0.5rem; padding-bottom:0.5rem;">GENDER</th>
                <th style="padding-top:0.5rem; padding-bottom:0.5rem; border-bottom: 1px solid #666">PARENT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            @php
                $parent = $member->student->parents()->first();
            @endphp
            <tr style="border-top: 1px solid #666">
                <td style="padding: 0.3rem 0; text-align:center; border-bottom: 1px solid #666">{{$loop->iteration}}</td>
                <td style="padding: 0.3rem 0; text-align:center; border-bottom: 1px solid #666; text-align:left">
                    {{ucwords(strtolower($member->first_name.' '.$member->second_name.' '.$member->sur_name))}}
                </td>
                <td style="padding: 0.3rem 0; text-align:center; border-bottom: 1px solid #666">{{ucwords(strtolower($member->gender))}}</td>

                <td style="padding: 0.3rem 0; text-align:center; border-bottom: 1px solid #666">
                    @if ($parent->guardian->particulars->active_phone)
                    {{$parent->guardian->particulars->active_phone->number->phone}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection
