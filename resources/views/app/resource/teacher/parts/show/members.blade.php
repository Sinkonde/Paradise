@section('members')
<div class="w-full text-sm">
    <div class="flex justify-between pb-5 text-gray-400">
        <p class="text-2xl font-semibold">
        @if (count($class->members))
            All members ({{count($class->members)}})
        @else
            No any member so far!
        @endif
        </p>
        <a title="Register New Member" class="fixed absolute bottom-5 right-4" href="{{route('students.create', ['class'=> $class->id, 'callback' => route('classes.show',['class'=>$class->id,'link'=>'m'])])}}"><button class="py-2 px-4 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </button></a>
    </div>
    @if (count($class->members))
    <table class="w-full">
        <thead class="stick top-10">
            <tr class="">
                <th class=" py-3">SN</th>
                <th class="text-left py-3">NAME</th>
                <th class=" py-3">GENDER</th>
                <th class="text-left py-3">PARENT</th>
                <th class=" py-3">PHONE</th>
                <th class=" py-3">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($class->members as $member)
            <tr class="border-t border-gray-200">
                <td class="text-center py-2">{{$loop->iteration}}</td>
                <td class="py-2">{{ucwords(strtolower($member->student->particulars->first_name.' '.$member->student->particulars->second_name.' '.$member->student->particulars->sur_name))}}</td>
                <td class="text-center py-2">{{ucwords(strtolower($member->student->particulars->gender))}}</td>
                <td class="py-2">{{ucwords(strtolower($member->student->parents()->first()->guardian->particulars->first_name.' '.$member->student->parents()->first()->guardian->particulars->second_name.' '.$member->student->parents()->first()->guardian->particulars->sur_name))}}</td>
                <td class="py-2 text-center">{{$member->student->parents()->first()->guardian->particulars->active_phone->number->phone}}</td>
                <td class="text-center py-2">
                    <a href="{{route('students.edit', ['student'=>$member->student->id, 'callback' => route('classes.show',['class'=>$class->id,'link'=>'m'])])}}"><button class="text-xs text-blue-600 hover:bg-blue-100 px-2 py-1 rounded" title="Edit">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
