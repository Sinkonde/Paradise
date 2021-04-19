<div style="margin-top:0px">
    @php
        $info = $student;
        $particulars = $info->student->particulars;
        $class = $info->class
    @endphp
    <table style="width:100%; margin:0px; font-size:14px; border-collapse:collapse;">
        <tr class="bg-gray-200" style="background-color: #e5e7eb">
            <td style="padding:7px; ">Mwanafunzi: <b>{{strtoupper($particulars->first_name.' '.$particulars->second_name.' '.$particulars->sur_name)}}</b></td>
            <td style="padding:7px; text-align: right">Darasa: <b>{{strtoupper($class->grade->name.' - '.$class->stream->name)}}</b></td>
        </tr>

    </table>
</div>
