@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">All Subjects <span>({{$subjects->count()}} Subjects)</span></p>
                <a class="absolute right-4 bottom-4" href="{{route('level-subjects.create')}}">
                    <x-form.button color='yellow' label='New' />
                </a>
            </div> --}}

            <div class="w-full px-4 hidden md:flex">
                @if (count($subjects) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-2">SN</th>
                            <th class="pb-2 text-left">Name</th>
                            <th class="pb-2 text-left">For</th>
                            <th class="pb-2 text-left">Description</th>
                            <th class="pb-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">{{$subject->subject->name}}</td>
                                <td class="py-2">
                                    {{$subject->level->name}}
                                </td>
                                <td class="py-2">{{$subject->subject->description}}</td>
                                <td class="py-2 flex flex-row">
                                        <form action="{{route('level-subjects.destroy', $subject->id)}}" method="post">
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
@endsection
@section('title')
<p class="text-lg text-gray-600 font-normal md:font-thin">All Subjects <span>({{$subjects->count()}} Subjects)</span></p>
@endsection
