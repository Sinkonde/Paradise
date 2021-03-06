@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 md:bg-white md:shadow">

            <div class="w-full md:px-4 md:flex text-sm">
                @if (count($classes) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full hidden md:table">
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
                                            @if (count($class->members) == 0)
                                                <button class="cursor-pointer hover:underline text-red-500 hover:text-red-400" role="button">Delete</button>
                                            @endif                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="md:hidden">
                    @foreach ($classes as $class)
                    <div class="flex flex-col justify-between items-center mb-4 bg-white rounded p-4 shadow">
                        <div class="flex flex-col w-full">
                            <p class="text-lg"><a class="text-blue-500 hover:underline" href="{{route('classes.show',$class->id)}}">Class {{$class->grade->name}} {{$class->stream->name}}</a></p>
                            <p class="text-gray-500 font-thin text-sm">
                                <b class="font-semibold">{{count($class->members)}}</b> Members <span class="font-normal">&middot;</span>
                                Year <span class=""><b class="font-semibold">{{$class->academic_year->year}}</b> <span class="font-normal">&middot;</span></span>
                                In <b class="font-semibold">{{ucwords($class->grade->level->name)}}</b></p>
                        </div>
                        <div class="flex justify-between w-full">
                            <a></a>
                            <div class="flex">

                                        <form action="{{route('classes.destroy', $class->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            @if (count($class->members) == 0)
                                            <button class="cursor-pointer hover:underline text-red-500 hover:text-red-600" role="button">Delete</button>
                                            @endif

                                        </form>
                                        <a class="ml-4 text-blue-400 hover:underline hover:text-blue-600" href="{{route('classes.edit', $class->id)}}">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <a href="{{route('classes.create',['callback' => route('classes.index')])}}" class="fixed bottom-4 right-4">
        <button class="rounded-full p-4 md:p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-semibold">Classes <span>({{$classes->count()}} classes)</span></p>
@endsection
