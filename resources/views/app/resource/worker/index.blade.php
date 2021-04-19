@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">

            <div class="w-full px-4 hidden md:flex text-xs">
                @if (count($workers) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-2">SN</th>
                            <th class="pb-2 text-left">Name</th>
                            <th class="pb-2 text-left">Gender</th>
                            <th class="pb-2 text-left">Depertment</th>
                            <th class="pb-2 text-left">Joined</th>
                            <th class="pb-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workers as $worker)
                            <tr class="hover:bg-gray-100">
                                <td class="py-1 text-center">{{$loop->iteration}}</td>
                                <td class="py-1">
                                    <a href="{{route('users.show',$worker->guardian->particulars->id)}}" class="hover:underline hover:text-blue-500">
                                        {{ucwords($worker->guardian->particulars->first_name.' '.$worker->guardian->particulars->second_name." ".$worker->guardian->particulars->sur_name)}}
                                    </a>
                                </td>
                                <td class="py-1">{{$worker->guardian->particulars->gender}}</td>
                                <td class="py-1">
                                    @foreach ($worker->worker_depertments as $wd)
                                        {{$wd->depertment->name}}
                                    @endforeach
                                </td>
                                <td class="py-1">{{$worker->joined}}</td>
                                <td class="py-1 flex flex-row">
                                    <a class="mr-4 text-blue-400 hover:underline hover:text-blue-600" href="{{route('workers.edit', $worker->id)}}">Edit</a>
                                        <form action="{{route('workers.destroy', ['worker' =>$worker->id])}}" method="post">
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

    <a class="fixed right-4 bottom-4" href="{{route('workers.create')}}">
        <x-form.button color='yellow' label='New' />
    </a>
@endsection

@section('title')
<p class="md:text-lg text-gray-600 font-thin">All Workers <span>({{$workers->count()}} workers)</span></p>
@endsection
