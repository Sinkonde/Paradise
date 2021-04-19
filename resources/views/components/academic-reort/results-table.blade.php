@inject('subject', 'App\Models\SubjectTeacher')
<p style="padding-top:15px"><b>A: MATOKEO YA MTIHANI</b> - <i>{{title($report->main_exam->name)}}</i></p>
<table style="width: 100%; margin-top:5px; border-collapse:collapse">
    <tr>
        <th style="border:1px solid gray; padding-top:5px; padding-bottom:5px">SN</th>
        <th style="padding-left:5px; text-align: left; border:1px solid gray; padding-top:5px; padding-bottom:5px">Somo</th>
        <th style="border:1px solid gray; padding-top:5px; padding-bottom:5px">Maksi</th>
        <th style="border:1px solid gray; padding-top:5px; padding-bottom:5px">Gredi</th>
        <th style="border:1px solid gray; padding-top:5px; padding-bottom:5px">Nafasi<br />kwenye Somo</th>
        <th style="border:1px solid gray; padding-top:5px; padding-bottom:5px">Maoni</th>
        <th style="padding-left:5px; text-align: left; border:1px solid gray; padding-top:5px; padding-bottom:5px">Mwalimu</th>
    </tr>

    @foreach ($results['subjects'] as $s => $mark)
    <tr>
        <td  style="text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px">{{$loop->iteration}}</td>
        @if ($subject->find($s))
            <td style="padding-left:5px; text-align: left; border:1px solid gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->sw_name}}">{{title($subject->find($s)->class_subject->level_subject->subject->sw_name)}}</td>
        @endif

        @if ($subject->find($s))
            <td style="text-align: center; border:1px solid gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{$mark}}</td>
        @endif

        @if ($subject->find($s))
            <td style="text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{setGrade($mark)}}</td>
        @endif

        @if ($subject->find($s))
            <td style="text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{subjectWisePosition($s, $student)}}</td>
        @endif

        @if ($subject->find($s))
            <td style="text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{setComments($mark)}}</td>
        @endif

        @if ($subject->find($s))
            <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">
                @php
                    $teacher = $subject->find($s)->teacher->worker->guardian->particulars
                @endphp
                @if ($teacher->gender == 'm')
                    {{('Mr. ')}}
                @else
                    {{('Madam ')}}
                @endif
                {{ucwords($teacher->first_name[0].'. '.$teacher->sur_name)}}
            </td>
        @endif
    </tr>
    @endforeach
    <tr>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"><b>Jumla</b></td>
        <td style="padding-left:5px; text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px"><b>{{array_sum($results['subjects'])}}</b></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
    </tr>

    <tr>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"><b>Wastani</b></td>
        <td style="padding-left:5px; text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px"><b>{{round($results['total']/count($results['subjects']),1)}}</b></td>
        <td style="padding-left:5px; text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px"><b>{{setGrade($results['total']/count($results['subjects']))}}</b></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
        <td style="padding-left:5px; text-align: center;border:1px solid gray; padding-top:5px; padding-bottom:5px"><b>{{setComments($results['total']/count($results['subjects']))}}</b></td>
        <td style="padding-left:5px; text-align: left;border:1px solid gray; padding-top:5px; padding-bottom:5px"></td>
    </tr>
</table>

<div>
    <p>Jumla ya Maksi alizopata ni <b>{{array_sum($results['subjects'])}}</b> kati ya maksi <b>{{count($results['subjects'])*100}}</b></p>
    <p style="line-height: 7px">Amepata wastani wa <b>{{round($results['total']/count($results['subjects']),1)}}</b> ambao ni sawa na Gredi <b>'{{setGrade($results['total']/count($results['subjects']))}}'</b></p>
    <p style="line-height: 7px">Amekuwa mwanafunzi wa <b>{{$results['position']}}</b> kati ya wanafunzi <b>{{$totalStudents}}</b> waliopo darasani</p>
    <p>Maoni ya mwalimu wa darasa: <i>Aongeze bidii zaidi katika masomo!</i></p>
</div>
