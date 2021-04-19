@inject('subject', 'App\Models\SubjectTeacher')
@php
    $labels = ['A', 'B', 'C', 'D', 'E'];
    //dd($results['sub_summary']);
@endphp
@section('subs')
@if (isset($results['sub_summary']))
<table style="width:100%; border-collapse:collapse; font-size:14px">
    <tr style="background-color: #d4d5d7">
        <td style="border:1px solid black; text-align:center">SN</td>
        <td style="border:1px solid black; text-align:center">Short name</td>
        <td style="border:1px solid black">Subject name</td>
        <td style="border:1px solid black">Swahili name</td>
        <td style="border:1px solid black">Teacher</td>
    </tr>

    @foreach ($results['sub_summary'] as $sub => $summary)
    <tr>

        @php
            $teacher = $subject->find($sub)->teacher->worker->guardian->particulars;
        @endphp

        <td style="border:1px solid black; text-align:center; padding:3px">{{$loop->iteration}}</td>
        <td style="border:1px solid black; text-align:center; padding:3px">{{strtoupper($subject->find($sub)->class_subject->level_subject->subject->short)}}</td>
        <td style="border:1px solid black; padding:3px">{{title($subject->find($sub)->class_subject->level_subject->subject->name)}}</td>
        <td style="border:1px solid black; padding:3px">{{title($subject->find($sub)->class_subject->level_subject->subject->sw_name)}}</td>
        <td style="border:1px solid black; padding:3px">
            @if ($teacher->gender == 'm')
                Mr.
            @else
                Madam
            @endif
            {{ucwords($teacher->first_name[0].'. '.$teacher->sur_name)}}
        </td>

    </tr>
    @endforeach
</table>

@endif
@endsection
