<div class="w-full flex flex-col md:py-4 md:bg-white md:shadow">
    <div class="w-full flex justify-between items-center p-4 mb-4 border-b bg-white sticky top-12 shadow-lg">
        {{-- <p class="text-xl md:text-xl text-gray-600 font-thin">All Pupils in the school <span>({{$students->count()}})</span></p> --}}
        <input class="w-full py-1 px-4 text-sm bg-gray-50 border border-gray-200 focus:bg-white rounded " wire:model="searchStudent" placeholder="Search Student" />
        <span class="fi fi-spinner fi-spin -ml-4" wire:loading></span>

    </div>

    <div class="w-full px-4 hidden md:table flex-col text-sm">
        @if (count($students) == 0)
            <p class="text-xl font-semibold pl-4">Nothing to list</p>
        @else
        <table class="w-full mb-4">
            <thead>
                <tr>
                    @foreach (['SN', 'Name', 'Gender', 'Action'] as $item)
                        <?php $align = in_array($item,['Name', 'Action']) ? 'left': 'center' ?>
                        <th class="border-b border-gray-200 text-{{$align}} pb-1">{{$item}}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                <tr class="hover:bg-gray-50 py-2">
                    <td class="pl-4">{{($students->currentPage() - 1) * $students->perPage() + $loop->iteration}}.</td>
                    <td class="flex">
                        <a class="hover:text-blue-700 hover:underline mr-3" href="{{route('students.show', $student->student->id)}}">
                            {{ucwords($student->first_name.' '.$student->second_name.' '.$student->sur_name)}}
                        </a>
                        @if ($student->student->at_vacation->first())
                        <a href="#" class="px-2 bg-yellow-100 text-yellow-600 text-xs rounded-full hover:border" ondblclick="returnFromVacation('{{$student->student->at_vacation->first()->id}}', '{{ucwords($student->first_name.' '.$student->second_name.' '.$student->sur_name)}}')" title="Double click to return back from vacation">At vacation</a>

                        <form method="post" action="{{route('vacations.update', $student->student->at_vacation->first()->id)}}" id="{{$student->student->at_vacation->first()->id}}">
                            @csrf
                            {{method_field('patch')}}
                            <input name="vaca" value="{{$student->student->at_vacation->first()->id}}" hidden />
                        </form>
                        @endif
                    </td>
                    <td class="text-center">{{$student->gender}}</td>
                    <td class="flex">
                        <a href="{{route('students.edit', ['student' =>$student->student->id])}}">
                            {{-- <x-form.button label="Edit" /> --}} <button class="text-xs rounded px-2 py-1 hover:bg-blue-100 text-blue-600">Edit</button>
                        </a>
                        <form action="{{route('students.destroy', ['student' =>$student->student->id])}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            {{-- <x-form.button label="Delete" color="red" title="Delete" /> --}}
                            <button class="px-2 py-1 hover:bg-red-100 text-red-600 rounded text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pt-2 border-t px-2 border-gray-100">
            {{$students->links()}}
        </div>
        @endif
    </div>

    <script>
        function returnFromVacation(id, student)
        {
            event.preventDefault();
            if(confirm('Are you sure want to return '+student+' from home?')){
                document.getElementById(id).submit()
            }
        }
    </script>

    <div class="w-full px-0 md:hidden flex">
        @if (count($students) == 0)
            <p class="text-xl font-semibold px-2">Nothing to list</p>
        @else
        {{-- <table class="w-full">
            <tbody>
                @foreach ($students as $student)
                <tr class="hover:bg-gray-50">
                    <td class="pl-4 py-4">{{$loop->iteration}}</td>
                    <td class="py-4">{{ucwords($student->first_name.' '.$student->second_name.' '.$student->sur_name)}}
                    ({{$student->gender}})</td>
                    <td class="flex text-left py-4">
                        <a class="mr-4 cursor-pointer hover:underline text-blue-300 hover:text-blue-500" href="{{route('students.edit', ['student' =>$student->id])}}">
                            Edit
                        </a>
                        <form action="{{route('students.destroy', ['student' =>$student->student->id])}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            <span class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Delete</span>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}
        <div class="w-full flex flex-col">
            @foreach ($students as $student)
                <div class="w-full text-md bg-white rounded mb-2 shadow py-2 px-4">

                    <a class="text-blue-500 font-normal overflow-hidden truncate" href="{{route('students.show',$student->student->id)}}">{{ucwords($student->first_name.' '.$student->second_name.' '.$student->sur_name)}}</a>
                    <p class="text-sm text-gray-400">
                        @if ($student->gender == '')
                            Boy @else Girl
                        @endif &middot; Class {{$student->student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->grade->name.' '.$student->student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->stream->name}}
                         {{-- &middot; Registered: {{date("M Y", strtotime($student->joined))}} --}}
                    </p>
                    <div class="w-full">
                        <p class=" text-right">
                            <a class="text-blue-500 text-sm px-4" href="{{route('students.show', $student->student->id)}}">Show</a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>


</div>
