<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Results</title>
</head>
<body>
    @inject('subject', 'App\Models\SubjectTeacher')
    <h3>Student Results</h3>
    <table style="width:100%">
        <tr>
            <td style="padding: px px; border:1px divide-dotted">Jina la mwanafunzi</td>
            <td style="padding: px px; border:1px divide-dotted"><b>{{$student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name}}</b></td>
        </tr>
        <tr>
            <td style="padding: px px; border:1px divide-dotted">Jinsia</td>
            <td style="padding: px px; border:1px divide-dotted">{{$student->particulars->gender}}</td>
        </tr>

        <tr>
            <td style="padding: px px; border:1px divide-dotted">Darasa</td>
            @php
                $class = $student->current_class()->first()->class;
            @endphp
            <td style="padding: px px; border:1px divide-dotted">{{$class->grade->name.' '.$class->stream->name}}</td>
        </tr>

        <tr>
            <td style="padding: px px; border:1px divide-dotted">Mwaka</td>
            <td style="padding: px px; border:1px divide-dotted">{{$class->academic_year->year}}</td>
        </tr>

        <tr>
            <td style="padding: px px; border:1px divide-dotted">Jina la mtihani</td>
            <td style="padding: px px; border:1px divide-dotted"><b>{{title($exam->name)}}</b></td>
        </tr>
    </table>

    <table style="width: 100%; margin-top:5px; border-collapse:collapse">
        <tr>
            <th style="border:1px dashed gray; padding-top:5px; padding-bottom:5px">SN</th>
            <th style="padding-left:5px; text-align: left; border:1px dashed gray; padding-top:5px; padding-bottom:5px">Somo</th>
            <th style="border:1px dashed gray; padding-top:5px; padding-bottom:5px">Maksi</th>
            <th style="border:1px dashed gray; padding-top:5px; padding-bottom:5px">Gredi</th>
            <th style="border:1px dashed gray; padding-top:5px; padding-bottom:5px">Maoni</th>
            <th style="padding-left:5px; text-align: left; border:1px dashed gray; padding-top:5px; padding-bottom:5px">Mwalimu</th>
        </tr>

        @foreach ($results['subjects'] as $s => $mark)
        <tr>
            <td  style="text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px">{{$loop->iteration}}</td>
            @if ($subject->find($s))
                <td style="padding-left:5px; text-align: left; border:1px dashed gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{title($subject->find($s)->class_subject->level_subject->subject->name)}}</td>
            @endif

            @if ($subject->find($s))
                <td style="text-align: center; border:1px dashed gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{$mark}}</td>
            @endif

            @if ($subject->find($s))
                <td style="text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{setGrade($mark)}}</td>
            @endif

            @if ($subject->find($s))
                <td style="text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{setComments($mark)}}</td>
            @endif

            @if ($subject->find($s))
                <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px" class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">
                    @php
                        $teacher = $subject->find($s)->teacher->worker->guardian->particulars
                    @endphp
                    {{ucwords($teacher->first_name.' '.$teacher->sur_name)}}
                </td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"></td>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"><b>Jumla</b></td>
            <td style="padding-left:5px; text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px"><b>{{array_sum($results['subjects'])}}</b></td>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"></td>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"></td>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"></td>
        </tr>

        <tr>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"></td>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"><b>Wastani</b></td>
            <td style="padding-left:5px; text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px"><b>{{$results['total']/count($results['subjects'])}}</b></td>
            <td style="padding-left:5px; text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px"><b>{{setGrade($results['total']/count($results['subjects']))}}</b></td>
            <td style="padding-left:5px; text-align: center;border:1px dashed gray; padding-top:5px; padding-bottom:5px"><b>{{setComments($results['total']/count($results['subjects']))}}</b></td>
            <td style="padding-left:5px; text-align: left;border:1px dashed gray; padding-top:5px; padding-bottom:5px"></td>
        </tr>
    </table>
    <p>Amekuwa wa {{$results['position']}}</p>
</body>
</html>
