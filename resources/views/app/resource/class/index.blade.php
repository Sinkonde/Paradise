@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b">

                <a href="{{route('classes.create')}}">
                    <x-form.button color='yellow' label='Create New Class' />
                </a>
            </div> --}}

            <div class="w-full px-4 hidden md:flex text-sm">
                @if (count($classes) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-2">SN</th>
                            <th class="pb-2 text-left">Name</th>
                            <th class="pb-2 text-left">Students</th>
                            <th class="pb-2 text-left">Academic Year</th>
                            <th class="pb-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <a class="text-blue-500 hover:text-blue-600 hover:underline" href="{{route('classes.show',$class->id)}}">{{$class->grade->name}} {{$class->stream->name}}</a>
                                </td>
                                <td class="py-2">{{count($class->members)}}</td>
                                <td class="py-2">{{$class->academic_year->year}}</td>
                                <td class="py-2 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('classes.edit', $class->id)}}">Edit</a>
                                        <form action="{{route('classes.destroy', $class->id)}}" method="post">
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

    <a href="{{route('classes.create',['callback' => route('classes.index')])}}" class="absolute bottom-4 right-4">
        <button class="rounded-full p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-semibold">All Classes so far <span>({{$classes->count()}} classes)</span></p>
@endsection
