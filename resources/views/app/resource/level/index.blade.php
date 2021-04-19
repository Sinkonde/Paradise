@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">

            <div class="w-full px-4 hidden md:flex text-sm">
                @if (count($levels) == 0)
                    <p class="text-2xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">SN</th>
                            <th class="pb-4 text-left">Name</th>
                            <th class="pb-4 text-left">Description</th>
                            <th class="pb-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($levels as $level)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">{{$level->name}}</td>
                                <td class="py-2">{{$level->description}}</td>
                                <td class="py-2 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('levels.edit', $level->id)}}">Edit</a>
                                        <form action="{{route('levels.destroy', ['level' =>$level->id])}}" method="post">
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

@section('title')
    <p class="text-lg md:text-lg text-gray-600 font-thin">All Levels <span>({{$levels->count()}} levels)</span></p>
@endsection

<a class="fixed right-5 bottom-5" href="{{route('levels.create')}}">
    <x-form.button color='yellow' label='Create New' />
</a>
