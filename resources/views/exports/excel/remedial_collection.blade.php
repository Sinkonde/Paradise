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
        <thead style="font-weight: 600">

            <tr>
                <td colspan="5" style="text-align:center; font-weight:600; text-transform:uppercase" class="font-semibold text-red-600">The Shining Nursery and Primary school</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:center; font-weight:600; text-transform:uppercase">Remedial fees collection for class {{strtoupper($class->grade->name.'-( '.$class->academic_year->year.' )')}}</td>
            </tr>
            <tr><td></td></tr>
           <tr>
               <th class="border text-center"  style="text-align:center; border:1px solid rgb(124, 123, 123); font-weight:600; text-transform:uppercase">SN</th>
               <th class="border text-center"  style="border:1px solid rgb(124, 123, 123); font-weight:600; text-transform:uppercase">Name</th>
               <th class="border text-center"  style="text-align:center; border:1px solid rgb(124, 123, 123); font-weight:600; text-transform:uppercase">Parent Phone</th>
               <th class="border text-center"  style="text-align:center; border:1px solid rgb(124, 123, 123); font-weight:600; text-transform:uppercase">Remedial I</th>
               <th class="border text-center"  style="text-align:center; border:1px solid rgb(124, 123, 123); font-weight:600; text-transform:uppercase">Remedial II</th>
           </tr>

        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr style="">
                @php
                    $parent = $student->student->parents()->first();
                @endphp
                <td style="text-align:center; border:1px solid rgb(70, 70, 70); @if ($loop->index % 2 == 0) background-color:rgb(70, 70, 70) @endif">{{$loop->iteration}}</td>
                <td style="border:1px solid rgb(70, 70, 70); @if ($loop->index % 2 == 0) background-color:rgb(124, 123, 123) @endif">{{title($student->first_name.' '.$student->second_name.' '.$student->sur_name)}}</td>
                <td style="text-align:center; border:1px solid rgb(70, 70, 70); @if ($loop->index % 2 == 0) background-color:rgb(70, 70, 70) @endif">
                    @if ($parent->guardian->particulars->active_phone)
                        @if ($parent->guardian->particulars->active_phone->number->phone != 0)
                            {{$parent->guardian->particulars->active_phone->number->phone}}
                        @endif
                    @endif
                </td>
                <td style="border:1px solid rgb(124, 123, 123); @if ($loop->index % 2 == 0) background-color:rgb(70, 70, 70) @endif">
                </td>
                <td style="border:1px solid rgb(124, 123, 123); @if ($loop->index % 2 == 0) background-color:rgb(70, 70, 70) @endif">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
