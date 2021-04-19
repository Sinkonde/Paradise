@extends('index')
@section('contents')
    <div class="w-100 flex justify-between m-10">
        <div class="w-full md:w-1/2 lg:w-1/4 rounded bg-white shadow">
            <div class="head w-full p-4 font-thin text-lg border-b">
                Summary
            </div>
            <div class="w-full p-4 font-thin text-xs">
                <table class="text-xs">
                    <tr>
                        <td class="py-2 text-left border-b border-gray-100">Name:</td>
                        <th class="p-2 text-left border-b border-gray-100">{{$level->name}}</th>
                    </tr>
                    <tr>
                        <td class="py-2 text-left border-b border-gray-100">Description:</td>
                        <th class="p-2 text-left border-b border-gray-100">{{ucfirst($level->description)}}</th>
                    </tr>
                    <tr>
                        <td class="py-2 text-left border-b border-gray-100">No of Grades:</td>
                        <th class="p-2 text-left border-b border-gray-100">{{count($level->grades)}}</th>
                    </tr>
                    <tr>
                        <td class="py-2 text-left border-b border-gray-100">No of Streams:</td>
                        <th class="p-2 text-left border-b border-gray-100">{{count($level->streams)}}</th>
                    </tr>
                    <tr>
                        <td class="py-2 text-left">No of Subjects:</td>
                        <th class="p-2 flex justify-between ">
                            {{count($level->subjects)}}
                            <a href="{{route('subjects.create')}}" class="bg-blue-600 hover:bg-blue-400 rounded py-1 px-3 text-white">Add</a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
