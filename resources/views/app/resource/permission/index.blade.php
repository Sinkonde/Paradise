@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 md:bg-white md:shadow">
            <div class="w-full md:px-4 text-sm">
                @if (count($permissions) == 0)
                    <p class="text-2xl font-semibold">Nothing to list</p>
                @else
                <table class="hidden md:table w-full ">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">#</th>
                            <th class="pb-4 text-left">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <a href="{{route('permissions.show', $permission->id)}}" class="hover:underline">{{ucfirst($permission->name)}}</a>
                                </td>
                                <td class="py-2 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('permissions.edit', $permission->id)}}">Edit</a>
                                        <form action="{{route('permissions.destroy', $permission->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Delete</button>
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="md:hidden w-full">
                    @foreach ($permissions as $role)
                    <div class="w-full py-5 mb-4 flex flex-col bg-white px-3 rounded shadow">
                        <p class="text-lg"><a href="{{route('permissions.show', $permission->id)}}" class="hover:text-blue-500">{{ucfirst($permission->name)}}</a></p>
                        {{-- <p class="text-gray-300">{{ucfirst($role->description)}}</p> --}}
                    </div>
                   @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    <a class="fixed right-5 bottom-5" href="{{route('permissions.create')}}">
        <x-form.button color='yellow' label='Create Permission' />
    </a>
@endsection

@section('title')
    <p class="text-lg md:text-lg text-gray-600 font-thin">All Permissions <span>({{$permissions->count()}} permissions)</span></p>
@endsection

