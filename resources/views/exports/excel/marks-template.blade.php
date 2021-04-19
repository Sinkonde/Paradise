<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marks template</title>
</head>
<body>
    <table>
        <thead>
           <tr>
               <th></th>
               <th colspan="{{2+count($class->subjects()->where('to',null)->get())}}" style="text-align:center">The Shining School</th>
           </tr>
           <tr>
               <th></th>
               <th colspan="{{2+count($class->subjects()->where('to',null)->get())}}" style="text-align:center">Result Template for {{strtoupper($class->grade->name.' '.$class->stream->name.'-('.$class->academic_year->year.')')}}</th>
           </tr>
           <tr>
               <th rowspan="2" style="text-align:center">REF NO</th>
               <th rowspan="2" style="text-align:center">SN</th>
               <th rowspan="2">NAME</th>
               <th colspan="{{count($class->subjects()->where('to',null)->get())}}" style="text-align:center">Subjects</th>
           </tr>
           <tr>
               @foreach ($class->subjects->where('to',null) as $subject)
                <th style="text-align:center">
                    {{strtoupper($subject->class_subject->level_subject->subject->short.'-('.$subject->reference_no.')')}}
                </th>
               @endforeach
           </tr>
        </thead>
        <tbody>
            @foreach ($class->members as $member)
            <tr>
                <td style="text-align:center">{{$member->reference_no}}</td>
                <td style="text-align:center">{{$loop->iteration}}</td>
                <td>
                    {{ucwords(strtolower($member->student->particulars->first_name.' '.$member->student->particulars->second_name.' '.$member->student->particulars->sur_name))}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
