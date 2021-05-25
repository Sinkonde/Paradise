@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full lg:w-4/5 flex flex-col py-4 bg-white shadow">
            {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Depertments</p>
                <a class="absolute bottom-5 right-5" href="{{route('depertments.create')}}">
                    <button class=" text-sm p-2 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white" >New</button>
                </a>
            </div> --}}

            <div class="w-full px-4 hidden md:flex">
                @if (count($depertments) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-2 text-gray-500">SN</th>
                            <th class="pb-2 text-left text-gray-500">Name</th>
                            <th class="pb-2 text-gray-500 text-center">Total Members</th>
                            <th class="pb-2 text-left text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depertments as $depertment)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 text-center">{{$loop->iteration}}
                                </td>
                                <td class="py-2 flex flex-col leading-2" style="line-height: 1.5">
                                    <span class="font-semibold">{{ucwords($depertment->name)}}</span>
                                    <span class="text-xs text-gray-500">{{ucfirst($depertment->description)}}</span>
                                </td>
                                <td class="py-2 text-center">{{count($depertment->members)}}</td>
                                <td class="py-2 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('depertments.edit', $depertment->id)}}">Edit</a>
                                        <form action="{{route('depertments.destroy', $depertment->id)}}" method="post">
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
<p class="text-lg">Depertments</p>
@endsection
