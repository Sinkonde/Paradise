@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full lg:w-4/5 flex flex-col py-8 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-8 md:pb-8 md:mb-8 border-b">
                <p class="text-xl md:text-2xl text-gray-600 font-thin">Academic Years</span></p>
                <a href="{{route('academic-years.create')}}">
                    <x-form.button color='yellow' label='New Academic Year' />
                </a>
            </div>

            <div class="w-full px-8 hidden md:flex">
                @if (count($academic_years) == 0)
                    <p class="text-2xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">SN</th>
                            <th class="pb-4 text-left">Academic Year</th>
                            <th class="pb-4 text-left">Comments</th>
                            <th class="pb-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($academic_years as $year)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 text-center">{{$loop->iteration}}</td>
                                <td class="py-4">{{$year->year}}</td>
                                <td class="py-4">{{$year->comments}}</td>
                                <td class="py-4 flex flex-row">
                                    <a class="mr-4 text-blue-400 hover:underline hover:text-blue-600" href="{{route('academic-years.edit', $year->id)}}">Edit</a>
                                        <form action="{{route('academic-years.destroy', $year->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Delete</button>
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
