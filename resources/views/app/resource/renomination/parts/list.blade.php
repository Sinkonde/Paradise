@section('list')

    <div class="flex justify-between py-4">
        <p class="text-xl font-semibold">Renominations</p>
        @php
            $religion = isset($religion) ? $religion->id : 'any';
        @endphp
        <a href="{{route('renominations.create')}}?religion_id={{$religion}}" class="text-blue">Add new</a>
    </div>

    <div class="w-100 flex justify-center ">

        <div class="w-full flex flex-col py-4 md:bg-white md:shadow">

            <div class="w-full md:px-4 md:flex text-sm">
                @if (count($renominations) == 0)
                    <p class="text-xl font-semibold">No any renominations</p>
                @else
                <table class="w-full hidden md:table">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-2">SN</th>
                            <th class="pb-2 text-left">Name</th>
                            <th class="pb-2 text-left">Description</th>
                            <th class="pb-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($renominations as $renomination)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <a class="text-blue-500 hover:text-blue-600 hover:underline" href="{{route('renominations.show',$renomination->id)}}">{{$renomination->name}}</a>
                                    @if (isset($show_religion))
                                        <p class="text-xs text-gray-400" title="Religion">{{$renomination->religion->name}}</p>
                                    @endif
                                </td>
                                <td class="py-2">{{$renomination->description}}</td>
                                <td class="py-2 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('renominations.edit', $renomination->id)}}">Edit</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="md:hidden">
                    @foreach ($renominations as $renomination)
                    <div class="flex flex-col justify-between items-center mb-4 bg-white rounded p-4 shadow">
                        <div class="flex flex-col w-full">
                            <p class="text-lg"><a class="text-blue-500 hover:underline" href="{{route('renominations.show',$renomination->id)}}">{{$renomination->name}}</a></p>
                            <p class="text-gray-500 font-thin text-sm">{{$renomination->description}}</p>
                        </div>
                        <div class="flex justify-between w-full">
                            <a></a>
                            <div class="flex">

                                        <form action="{{route('renominations.destroy', $renomination->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            {{-- @if (count($class->members) == 0)
                                            <button class="cursor-pointer hover:underline text-red-500 hover:text-red-600" role="button">Delete</button>
                                            @endif --}}

                                        </form>
                                        <a class="ml-4 text-blue-400 hover:underline hover:text-blue-600" href="{{route('renominations.edit', $renomination->id)}}">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <a href="{{route('renominations.create',['callback' => route('renominations.index')])}}" class="fixed bottom-4 right-4">
        <button class="rounded-full p-4 md:p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection
