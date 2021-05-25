@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-2 bg-white shadow">

            <div class="w-full md:px-4 md:flex">
                @if (count($subjects) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class=" border-b border-gray-400 bg-gray-100 sticky">
                            <th class="py-4">SN</th>
                            <th class="py-4 text-left">Name</th>
                            {{-- <th class="py-2 text-left">Description</th> --}}
                            <th class="py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr class="hover:bg-gray-50 border-t">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <div>
                                        <p class="font-semibold">{{ucwords($subject->name)}} ({{strtoupper($subject->short)}})</p>
                                        <p class="text-xs text-gray-400">{{title($subject->sw_name)}}</p>
                                        <p class="text-sm text-gray-300">{{ucwords($subject->description)}}</p>
                                    </div>
                                </td>
                                {{-- <td class="py-2">{{$subject->description}}</td> --}}
                                <td class="py-2 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('subjects.edit', $subject->id)}}">Edit</a>
                                        <form action="{{route('subjects.destroy', $subject->id)}}" method="post" class="hidden">
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

    <div class="fixed right-4 bottom-4 flex">
        <a class="md:hidden mr-2 px-2 py-1 rounded bg-blue-500 border border-blue-400 text-white" href="{{route('level-subjects.create')}}">
            Assign to levels
        </a>
        <a class="" href="{{route('subjects.create')}}">
            <x-form.button color='yellow' label='New' />
        </a>
    </div>
@endsection

@section('title')
    <p class="text-lg text-gray-600 font-bold">All Subjects <span>({{$subjects->count()}} Subjects)</span></p>
@endsection

@section('navs')
<a class="hidden md:flex text-xs px-2 py-1 rounded-full bg-blue-50 border border-blue-400 text-blue-500 hover:bg-blue-100" href="{{route('level-subjects.create')}}">
    Assign to levels
</a>
@endsection
