@section('student')
<div class="w-full text-sm">
    <p class="pb-2 text-xl font-thin"><b>Particulars</b></p>
    <table class="border w-full">
        <tr>
            <th class="border-b py-2 px-2 text-left">Full name</th>
            <td class="border-b py-2 px-2">{{ucwords($student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name)}}</td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left  bg-gray-50">Gender</th>
            <td class="border-b py-2 px-2  bg-gray-50">{{$student->particulars->gender == 'm' ? 'Male' : 'Female'}}</td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left">Age</th>
            <td class="border-b py-2 px-2">{{date_diff(date_create($student->dob), date_create('now'))->y}} years</td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left  bg-gray-50">DOB</th>
            <td class="border-b py-2 px-2  bg-gray-50" title="{{date('Y', strtotime($student->dob))}}">{{date("jS M", strtotime($student->dob))}}</td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left">Current class</th>
            <td class="border-b py-2 px-2">
                <a class="text-blue-800 hover:underline" href="{{route('classes.show', $student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->id)}}">
                    {{$student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->grade->name.' '.$student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->stream->name}}
                </a>
            </td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left  bg-gray-50">Joined</th>
            <td class="border-b py-2 px-2  bg-gray-50" title="{{date('jS', strtotime($student->joined))}}">{{date("M Y", strtotime($student->joined))}}</td>
        </tr>
    </table>
    </div>
@endsection
