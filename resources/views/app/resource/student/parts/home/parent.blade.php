@section('parent')
<div class="w-full text-sm mt-5 bg-white rounded shadow-lg">
    <table class="border w-full">
        <tr class="border-b py-1 px-1 text-left bg-gray-200">
            <td colspan="2" class="px-1 py-2"><p class="font-semibold">Guarantor <b>{{$student->parents()->first()->relation->name}}</b></p></td>
        </tr>
        <tr>
            <th class="border-b py- px-2 text-left">Full name</th>
            <td class="border-b py- px-2">
                <a href="{{route('users.show', $student->parents()->first()->guardian->particulars->id)}}" class="hover:text-blue-500 hover:underline">
                    {{ucwords(strtolower($student->parents()->first()->guardian->particulars->first_name.' '.$student->parents()->first()->guardian->particulars->second_name.' '.$student->parents()->first()->guardian->particulars->sur_name))}}
                </a>
            </td>
        </tr>
        <tr>
            <th class="border-b py- px-2 text-left  bg-gray-50">Relation</th>
            <td class="border-b py- px-2  bg-gray-50">
                {{$student->parents()->first()->relation->name}}
            </td>
        </tr>
        <tr>
            <th class="border-b py- px-2 text-left">Phone Numbers</th>
            <td class="border-b py- px-2">
                <div class="flex flex-row">
                    @if (!empty($student->parents()->first()->guardian->particulars->phones))
                        @foreach ($student->parents()->first()->guardian->particulars->phones as $phone)
                        <span class="text-xs rounded-full bg-gray-100 px-1 mr-2">{{$phone->phone}}</span>
                        @endforeach
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <th class="border-b py- px-2 text-left  bg-gray-50">Work</th>
            <td class="border-b py- px-2  bg-gray-50">{{$student->parents()->first()->guardian->work}}</td>
        </tr>
        <tr>
            <th class="border-b py- px-2 text-left">Address</th>
            <td class="border-b py- px-2">
                {{$student->parents()->first()->guardian->address}}
            </td>
        </tr>
        <tr>
            <th class="border-b py- px-2 text-left  bg-gray-50">Email</th>
            <td class="border-b py- px-2  bg-gray-50" title="">{{$student->parents()->first()->guardian->particulars->email}}</td>
        </tr>
    </table>
    </div>
@endsection
