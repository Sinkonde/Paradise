@section('student')
<div class="w-full text-sm bg-white rounded shadow-lg">

    <table class="border w-full">
        <tr class="border-b py-1 px-1 text-left bg-gray-200">
            <td colspan="2" class="px-1 py-2"><p class="text-sm font-semibold"><b>About</b></p></td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left">Full name</th>
            <td class="border-b py- px-1">{{ucwords($student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name)}}</td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left  bg-gray-50">Gender</th>
            <td class="border-b py- px-1  bg-gray-50">{{$student->particulars->gender == 'm' ? 'Male' : 'Female'}}</td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left">Age</th>
            <td class="border-b py- px-1">{{date_diff(date_create($student->dob), date_create('now'))->y}} years</td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left  bg-gray-50">DOB</th>
            <td class="border-b py- px-1  bg-gray-50" title="{{date('Y', strtotime($student->dob))}}">{{date("jS M", strtotime($student->dob))}}</td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left ">Type</th>
            <td class="border-b py- px-1">
                <div class=" flex justify-between text-right">
                    @if ($student->current_class->first()->is_dayscholar->first())
                    <span class="rounded-full bg-green-100 text-green-400 text-xs px-2" title="From {{$student->current_class->first()->is_dayscholar->first()->route->name}}">Dayscholar</span>
                    <div class="w-full">
                        <form method="post" class="text-left flex justify-between" action="{{route('dayscholars.update',$student->current_class->first()->is_dayscholar->first()->id)}}" class="text-left">
                            @csrf
                            {{method_field('patch')}}
                            <p></p>
                            <p class="text-left"><button class="text-xs hover:underline text-green-600">Change to boarding</button></p>
                        </form>
                    </div>

                    @else
                    <span class="rounded-full bg-red-100 text-red-400 text-xs px-2">Boarding</span>
                    <div class="w-full" x-data={show:false}>
                        <span class="text-blue-600 text-xs hover:underline cursor-pointer text-right" @click="show=true">Make dayscholar</span>
                        <div class="w-2/12 p-1 rounded bg-white absolute z-20 border shadow" x-show="show" @click.away="show=false">

                            <form method="post" action="{{route('dayscholars.store')}}" class="text-left">
                                @csrf
                                <p class="text-sm mb-2 text-gray-500 font-thin">Choose Route</p>
                                <input type="hidden" value="{{$student->current_class->first()->id}}" name="student_id" />
                                <select class="w-full font-thin border rounded bg-gray-50 mb-2 text-gray-500 focus:text-gray-700 text-xs" name="route_id">
                                    @foreach ($routes as $route)
                                        <option value="{{$route->id}}">{{ucwords($route->name)}}</option>
                                    @endforeach
                                </select>
                                <button class="text-xs w-full rounded bg-blue-300 hover:bg-blue-200 text-white">Okay</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left bg-gray-50">Current class</th>
            <td class="border-b py- px-1 bg-gray-50">
                <a class="text-blue-800 hover:underline" href="{{route('classes.show', $student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->id)}}">
                    {{$student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->grade->name.' '.$student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->stream->name}}
                </a>
            </td>
        </tr>
        <tr>
            <th class="border-b py- px-1 text-left">Joined</th>
            <td class="border-b py- px-1" title="{{date('jS', strtotime($student->joined))}}">{{date("M Y", strtotime($student->joined))}}</td>
        </tr>
    </table>
    </div>
@endsection
