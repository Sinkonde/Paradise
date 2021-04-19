@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b" x-data="{'show':false}">
                <p class="text-xl md:text-xl text-gray-600 font-thin"><span @click="show=!show" class="fi fi-angle-down hover:text-gray-600 text-gray-300 cursor-pointer text-sm"></span> <b class="cursor-pointer" @click="show=!show">{{$level_name?$level_name:__('All')}}</b> Streams ({{$streams->count()}} streams)</span></p>
                <div x-show="show" class="absolute bg-white rounded mt-28 flex flex-col border shadow-lg" @click.away="show=false">
                    <a class="px-2 text-sm py-2 hover:bg-gray-100 text-xs" href="{{route('streams.index')}}">All</a>
                    @foreach ($levels as $level)
                        <a class="px-2 text-sm py-1 hover:bg-gray-100 text-xs" href="{{route('streams.index',['for_level' => $level->id])}}">{{$level->name}} streams</a>
                     @endforeach
                </div>

                <a class="absolute right-5 bottom-5" href="{{route('streams.create')}}">
                    <x-form.button color='yellow' label='New' />
                </a>
            </div>

            <div class="w-full px-4 hidden md:flex">
                @if (count($streams) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-2">SN</th>
                            <th class="pb-2 text-left">Name</th>
                            <th class="pb-2 text-left">Description</th>
                            <th class="pb-2 text-left">For Level</th>
                            <th class="pb-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($streams as $stream)
                            <tr class="hover:bg-gray-100 text-xs">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">{{$stream->name}}</td>
                                <td class="py-2">{{$stream->description}}</td>
                                <td class="py-2">{{$stream->level->name}}</td>
                                <td class="py-2 flex flex-row">
                                    <a class="mr-4 text-blue-400 hover:underline hover:text-blue-600" href="{{route('streams.edit', $stream->id)}}">Edit</a>
                                        <form action="{{route('grades.destroy', ['grade' =>$stream->id])}}" method="post">
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
