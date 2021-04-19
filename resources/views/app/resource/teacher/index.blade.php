@extends('index')
@section('contents')
    <div class="w-100 flex justify-center">
        <div class="w-full flex flex-col py-4 bg-white shadow rounded">
            <div class="w-full flex justify-between items-center px-4 pb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">All Teachers</p>
                <p class="text-xl md:text-xl text-gray-600 cursor-arrow" title="Total Teachers">{{$teachers->count()}}</span></p>
            </div>

            <div class="w-full px-4 hidden md:flex">
                @if (count($teachers) == 0)
                    <p class="text-xl font-semibold text-gray-400">No any teachers yet! <a class="text-blue-400 hover:text-blue-500 hover:underline" href="{{route('teachers.create',['callback' => route('teachers.index')])}}">Add</a> now</p>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">SN</th>
                            <th class="pb-4 text-left">Name</th>
                            <th class="pb-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <a href="#" class="hover:underline hover:text-blue-800">
                                    {{$teacher->worker->guardian->particulars->gender == 'm' ? 'Mr. ' : "Madam "}}
                                    {{ucwords(strtolower($teacher->worker->guardian->particulars->first_name.' '.$teacher->worker->guardian->particulars->second_name.' '.$teacher->worker->guardian->particulars->sur_name))}}
                                    </a>
                                </td>
                                <td class="py-2 flex flex-row">
                                    <form action="{{route('teachers.destroy', $teacher->id)}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Remove</button>
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

    <a href="{{route('teachers.create',['callback' => route('titles.index')])}}" class="absolute bottom-4 right-4">
        <button class="rounded-full p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection
