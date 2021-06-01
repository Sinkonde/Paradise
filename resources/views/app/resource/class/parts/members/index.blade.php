
@section('members')
<div class="w-full text-sm md:bg-white -mt-4 md:p-4 pt-4 md:shadow">
    <div class="flex justify-between pb-5 text-gray-900 md:text-gray-500 md:border-b border-gray-100">
        <div>
            <p class="text-lg md:font-thin">
                @if (count($class->members))
                    All members ({{count($class->members)}})
                @else
                    No any member so far!
                @endif
            </p>
        </div>
        <div class="flex items-center">
            <a href="{{route('classes.show',['class'=>$class->id, 'import_members'=>'pdf'])}}" title="List in PDF">
                <span class="bg-red-50 border border-red-300 md:border-0 md:hover:bg-red-100 px-2 py-1 rounded text-red-500 hover:text-red-600 ">PDF</span>
            </a>
        </div>

    </div>
    @if (count($class->members))
    <table class="w-full hidden md:table">
        <thead class="stick top-10">
            <tr class="bg-gray-100">
                <th class=" py-3">SN</th>
                <th class="text-left py-3">NAME</th>
                <th class=" py-3"></th>
                <th class=" py-3">GENDER</th>

                <th class="text-left py-3">PARENT</th>
                <th class=" py-3">PHONE</th>
                <th class=" py-3">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            @php
                $parent = $member->student->parents()->first();
            @endphp
            <tr class="border-t border-gray-200 hover:bg-gray-50">
                <td class="text-center py-2">{{$loop->iteration}}</td>
                <td class="py-2">
                    <a class="hover:text-blue-700 hover:underline" href="{{route('students.show', $member->student->id)}}">
                        {{ucwords(strtolower($member->first_name.' '.$member->second_name.' '.$member->sur_name))}}
                    </a>
                </td>
                <td class="text-center py-2">{!!!is_null($member->student->current_class()->first()->is_dayscholar->first())?"<span class='bg-gray-200 rounded-full px-2 text-xs'>Dayscholar<span>":null!!}</td>
                <td class="text-center py-2">{{ucwords(strtolower($member->gender))}}</td>

                <td class="py-2">{{ucwords(strtolower($member->student->parents()->first()->guardian->particulars->first_name.' '.$member->student->parents()->first()->guardian->particulars->second_name.' '.$member->student->parents()->first()->guardian->particulars->sur_name))}}</td>
                <td class="py-2 text-center">
                    @if ($parent->guardian->particulars->active_phone)
                    {{$parent->guardian->particulars->active_phone->number->phone}}
                    @endif
                </td>
                <td class="text-center py-2">
                    <a href="{{route('students.edit', ['student'=>$member->student->id, 'callback' => route('classes.show',['class'=>$class->id,'link'=>'m'])])}}"><button class="text-xs text-blue-600 hover:bg-blue-100 px-2 py-1 rounded" title="Edit">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                    </a>
                    <a onclick="event.preventDefault();
                    confirmDelete('{{ucwords(strtolower($member->first_name.' '.$member->second_name.' '.$member->sur_name))}}', 'delMem{{$member->id}}')" class= "cursor-pointer text-red-500 hover:text-red-600 px-2 py-0 rounded hover:bg-red-100" title="Delete">
                        &times;
                    </a>
                    <form id="delMem{{$member->id}}" action="{{route('users.destroy', $member->id)}}" method="POST" class="hidden">
                        @csrf
                        {{method_field('delete')}}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-full md:hidden">
        @foreach ($members as $member)
            @php
                $parent = $member->student->parents()->first();
            @endphp
            <div class="w-full bg-white rounded shadow mb-4 flex flex-col p-4">
                <div class="flex flex-col mb-2">
                    <p class="text-normal">
                        <a class="text-blue-800 hover:underline" href="{{route('students.show', $member->student->id)}}">
                            {{ucwords(strtolower($member->first_name.' '.$member->second_name.' '.$member->sur_name))}}
                        </a>
                    </p>
                    <p class="text-gray-500 text-xs">
                        <span>@if ($member->gender == 'm')
                            Boy @else Girl
                        @endif</span>
                        &middot; <span title="{{date('Y', strtotime($member->dob))}}">{{$member->student->age}}</span> years
                    </p>
                </div>
                <div class="flex justify-between text-blue-500 w-full text-right">
                    <div></div>
                    <div>
                        <a href="{{route('students.edit', ['student'=>$member->student->id, 'callback' => route('classes.show',['class'=>$class->id,'link'=>'m'])])}}">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

<script>
    function confirmDelete(student, id){
        if(confirm('Are you sure want to delete '+student)){
            document.getElementById(id).submit();
        }
    }
</script>

<div class="fixed bottom-5 right-4 flex">
    <a title="Import Members" class="mr-2" href="{{route('students.create', ['type'=>'import','class'=> $class->id, 'callback' => route('classes.show',['class'=>$class->id,'link'=>'m'])])}}">
        <button class="py-2 px-4 bg-blue-400 hover:bg-blue-500 text-white rounded-full opacity-50 hover:opacity-100">
            <span class="fi fi-import"></span>
        </button>
    </a>

    <a title="Register New Member" href="{{route('students.create', ['class'=> $class->id, 'callback' => route('classes.show',['class'=>$class->id,'link'=>'m'])])}}">
        <button class="py-2 px-4 bg-yellow-400 hover:bg-yellow-500 text-white rounded-full opacity-50 hover:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </button>
    </a>
</div>
@endsection
