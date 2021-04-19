@section('parent')
<div class="w-full text-sm">
    <p class="pb-2 text-xl font-thin"><b>Parent</b></p>
    <table class="border w-full">
        <tr>
            <th class="border-b py-2 px-2 text-left">Full name</th>
            <td class="border-b py-2 px-2">{{ucwords(strtolower($student->parents()->first()->guardian->particulars->first_name.' '.$student->parents()->first()->guardian->particulars->second_name.' '.$student->parents()->first()->guardian->particulars->sur_name))}}</td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left  bg-gray-50">Relation</th>
            <td class="border-b py-2 px-2  bg-gray-50">
                {{$student->parents()->first()->relation->name}}
            </td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left">Phone Numbers</th>
            <td class="border-b py-2 px-2 flex flex-row">
                @if (!empty($student->parents()->first()->guardian->particulars->phones))
                    @foreach ($student->parents()->first()->guardian->particulars->phones as $phone)
                    <span class="text-xs rounded-full bg-gray-100 px-1 mr-2">{{$phone->phone}}</span>
                    @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left  bg-gray-50">Work</th>
            <td class="border-b py-2 px-2  bg-gray-50">{{$student->parents()->first()->guardian->work}}</td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left">Address</th>
            <td class="border-b py-2 px-2">
                {{$student->parents()->first()->guardian->address}}
            </td>
        </tr>
        <tr>
            <th class="border-b py-2 px-2 text-left  bg-gray-50">Email</th>
            <td class="border-b py-2 px-2  bg-gray-50" title="">{{$student->parents()->first()->guardian->particulars->email}}</td>
        </tr>
    </table>
    </div>
@endsection
