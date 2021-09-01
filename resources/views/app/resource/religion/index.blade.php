@extends('index')
@section('contents')
    <div class="w-100 flex justify-center">
        <div class="w-full flex flex-col py-4 md:bg-white md:shadow md:rounded">

            <div class="w-full md:px-4">
                @if (count($religions) == 0)
                    <p class="text-xl font-semibold text-gray-400">No any Religion yet! <a class="text-blue-400 hover:text-blue-500 hover:underline" href="{{route('religions.create',['callback' => route('religions.index')])}}">Add</a> now</p>
                @else
                <table class="w-full text-sm  hidden md:table">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">SN</th>
                            <th class="pb-4 text-left">Name</th>
                            <th class="pb-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($religions as $religion)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <a href="{{route('religions.show',$religion->id)}}" class="hover:underline hover:text-blue-800">
                                        {{ucwords(strtolower($religion->name))}}
                                    </a>
                                </td>
                                <td class="py-2 flex flex-row">
                                    <a href="{{route('religions.edit',$religion->id)}}" class="mr-4 cursor-pointer hover:underline text-blue-500 hover:text-blue-600" role="button">Edit</a>
                                    <form action="{{route('religions.destroy', $religion->id)}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <button class="cursor-pointer hover:underline text-red-500 hover:text-red-600" role="button">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    @foreach ($religions as $religion)
                    <div class="md:hidden p-3 bg-white rounded shadow my-2">
                        <div>
                            <p class="font-normal">
                                <a href="{{route('users.show',$religion->id)}}" class="hover:underline text-blue-500">
                                    {{ucwords(strtolower($religion->name))}}
                                </a>
                            </p>
                        </div>
                        <div class="justify-start items-stretch">
                            <form action="{{route('religions.destroy', $religion->id)}}" method="post">
                                @csrf
                                {{method_field('delete')}}
                                <button class="text-sm cursor-pointer hover:underline text-red-500 hover:text-red-500" role="button">Remove</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <a href="{{route('religions.create',['callback' => route('religions.index')])}}" class="absolute bottom-4 right-4">
        <button class="rounded-full p-4 md:p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-thin">Religions</p>
@endsection
