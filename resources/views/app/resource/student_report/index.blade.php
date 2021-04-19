@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">

            <div class="w-full px-4 hidden md:flex text-sm">
                @if (count($reports) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead class=" mb-4">
                        <tr>
                            @foreach (['SN', 'Name', 'Actions'] as $item)
                                <?php $align = in_array($item,['Name', 'Actions']) ? 'left': 'center' ?>
                                <th class="border-b border-gray-200 text-{{$align}} pb-4">{{$item}}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reports as $report)
                        <tr class="hover:bg-gray-50 py-2 text-xs">
                            <td class="pl-4 text-center">{{$loop->iteration}}</td>
                            <td>
                                <a class="hover:text-blue-700 hover:underline" href="{{route('student-reports.show', $report->id)}}">
                                    {{ucwords($report->name)}}
                                </a>
                            </td>
                            <td class="flex">
                                <a href="{{route('student-reports.edit', $report->id)}}">
                                    <button class="text-xs rounded px-2 py-1 hover:bg-blue-100 text-blue-600">Edit</button>
                                </a>
                                {{-- <form action="{{route('reports.destroy', $report->id)}}" method="post">
                                    @csrf
                                    {{method_field('delete')}}
                                    -- <x-form.button label="Delete" color="red" title="Delete" />
                                    <button class="px-2 py-1 hover:bg-red-100 text-red-600 rounded text-xs">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    <a class="fixed right-5 bottom-5" href="{{route('student-reports.create',['callback'=>url()->current()])}}">
        <x-form.button color='yellow' label='New' />
    </a>
@endsection

@section('title')
    <p class="text-lg md:text-lg text-gray-600 font-thin">All Academic Reports</span></p>
@endsection

