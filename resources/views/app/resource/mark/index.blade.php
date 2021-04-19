@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">All Pupils in the school <span>({{$students->count()}})</span></p>
                {{-- <a href="{{route('students.create')}}">
                    <x-form.button color='yellow' label='Register New' />
                </a> --}}
            </div>

            <div class="w-full px-4 hidden md:flex text-sm">
                @if (count($students) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
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
                            <td class="pl-4">{{$loop->iteration}}</td>
                            <td>
                                <a class="hover:text-blue-700 hover:underline" href="{{route('students.show', $student->id)}}">
                                    {{ucwords($student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name)}}
                                </a>
                            </td>
                            <td class="text-center">{{$student->particulars->gender}}</td>
                            <td class="flex">
                                <a href="{{route('students.edit', ['student' =>$student->id])}}">
                                    {{-- <x-form.button label="Edit" /> --}} <button class="text-xs rounded px-2 py-1 hover:bg-blue-100 text-blue-600">Edit</button>
                                </a>
                                <form action="{{route('students.destroy', ['student' =>$student->id])}}" method="post">
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
                @endif
            </div>

            <div class="w-full px-0 md:hidden flex">
                @if (count($students) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">

                    <tbody>
                        @foreach ($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="pl-4 py-4">{{$loop->iteration}}</td>
                            <td class="py-4">{{ucwords($student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name)}}
                            ({{$student->particulars->gender}})</td>
                            <td class="flex text-left py-4">
                                <a class="mr-4 cursor-pointer hover:underline text-blue-300 hover:text-blue-500" href="{{route('students.edit', ['student' =>$student->id])}}">
                                    Edit
                                </a>
                                <form action="{{route('students.destroy', ['student' =>$student->id])}}" method="post">
                                    @csrf
                                    {{method_field('delete')}}
                                    <span class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Delete</span>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>


        </div>
    </div>
@endsection
