@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full lg:w-full flex flex-col py-4 md:bg-white md:shadow">
            {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Depertments</p>
                <a class="absolute bottom-5 right-5" href="{{route('depertments.create')}}">
                    <button class=" text-sm p-2 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white" >New</button>
                </a>
            </div> --}}

            <div class="w-full md:px-4">
                @if (count($depertments) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full text-sm  hidden md:table">
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
                                        <form id="mdForm{{$loop->iteration}}" action="{{route('depertments.destroy', $depertment->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            @if (count($depertment->members) ==0)
                                            <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button" onclick="confirmDeleteDepertment('{{$depertment->name}}', 'mdForm'+'{{$loop->iteration}}')">Delete</button>
                                            @endif
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="md:hidden">
                    @foreach ($depertments as $depertment)
                    <div class="p-4 mb-4 bg-white rounded shadow">
                        <div class="mb-2">
                            <p class="text-md text-gray-900 font-medium mb-2">{{ucwords($depertment->name)}}</p>
                            <p class="text-sm text-gray-500" href="javascript:void(0)" onclick="deleteDepertment()">{{ucwords($depertment->description)}}</p>
                            <p class="text-xs text-gray-400" href="{{route('depertments.edit', $depertment->id)}}">Members: {{count($depertment->members)}}</p>
                        </div>
                        <div class="text-sm text-right">
                            @if (count($depertment->members)== 0)
                                <a class="text-red-500 mr-4">Delete</a>
                            @endif
                            <a class="text-blue-500" href="{{route('depertments.edit', $depertment->id)}}">Edit</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteDepertment(name, id){
            if (confirm('Are you sure want to delete '+name+' ?')) {
                document.getElementById(id).submit();
            }
        }
    </script>
@endsection

@section('title')
<p class="text-lg font-normal md:font-thin">Depertments</p>
@endsection
