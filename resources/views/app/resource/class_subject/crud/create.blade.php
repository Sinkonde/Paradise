@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            @if (!$subjects)
                <div class="">
                    <p class="py-4 px-8 font-bold text-gray-500">No any Subject dedicated so far! Create one</p>
                </div>
            @else
                <div class="w-full px-8 md:px-8 flex flex-col">
                    {{-- <p class="text-lg font-thin pb-2 mb-4 border-b">Choose subject to add to this class</p> --}}
                    <form action="{{route('class-subjects.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="callback" value="{{$callback ? $callback : NULL}}"/>
                        <input type="hidden" name="class" value="{{$class}}"/>
                        <table class="w-full text-sm table-auto">
                            <thead>
                                <tr>
                                    <th class="py-2 text-right pr-4 w-4">Select</th>
                                    <th class="py-2 text-left">Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $subject)
                                    @if (!in_array($subject->id, $avail))
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 flex justify-end pr-4 w-12">
                                            <input type="checkbox" name="subjects[]" value="{{$subject->id}}" />
                                        </td>

                                        <td class="py-2">
                                            {{ucwords(strtolower($subject->subject->name))}}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td class="pt-4">
                                        <button class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded">Done!</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg font-normal md:font-thin">Choose subject to add to this class</p>
@endsection
