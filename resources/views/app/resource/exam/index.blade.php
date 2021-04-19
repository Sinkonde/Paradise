@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">All Exams <span>({{$exams->count()}})</span></p>
            </div>

            <div class="w-full px-4 hidden md:flex text-sm">
                @if (count($exams) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr>
                            @foreach (['SN', 'Name', 'Type', 'Total Marks', 'Date', 'Actions'] as $item)
                                <?php $align = in_array($item,['Name', 'Actions']) ? 'left': 'center' ?>
                                <th class="border-b border-gray-200 text-{{$align}} pb-1">{{$item}}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($exams as $exam)
                        <tr class="hover:bg-gray-50 py-2">
                            <td class="pl-4 text-center">{{$loop->iteration}}</td>
                            <td>
                                <a class="hover:text-blue-700 hover:underline" href="{{route('exams.show', $exam->id)}}">
                                    {{ucwords($exam->name)}}
                                </a>
                            </td>
                            <td class="text-center">{{$exam->type}}</td>
                            <td class="text-center">{{$exam->total_marks}}</td>
                            <td class="text-center">{{$exam->date}}</td>
                            <td class="flex">
                                <a href="{{route('exams.edit', $exam->id)}}">
                                    {{-- <x-form.button label="Edit" /> --}} <button class="text-xs rounded px-2 py-1 hover:bg-blue-100 text-blue-600">Edit</button>
                                </a>
                                <form action="{{route('exams.destroy', $exam->id)}}" method="post">
                                    @csrf
                                    {{method_field('delete')}}
                                    {{-- <x-form.button label="Delete" color="red" title="Delete" /> --}}
                                    <button class="px-2 py-1 hover:bg-red-100 text-red-600 rounded text-xs">Delete</button>
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

    <a class="fixed bottom-5 right-5" href="{{route('exams.create')}}" title="create new exam">
        <button class=" text-sm py-1 px-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded" >New</button>
    </a>
@endsection
