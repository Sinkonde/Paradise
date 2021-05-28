@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            @if (is_null($for_level))
                <div class="">
                    <p class="py-4 px-8 font-bold text-gray-500">Choose Level</p>
                    <div class="flex flex-col border-t">
                        @foreach ($levels as $level)
                        <a class="px-8 text-sm py-4 hover:bg-gray-100" href="{{route('level-subjects.create',['for_level' => $level->id])}}">{{$level->name}}</a>
                        @endforeach
                    </div>
                </div>
            @else


                <div class="w-full px-8 md:px-8 flex flex-col">
                    <form action="{{route('level-subjects.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="callback" value="{{$callback ? $callback : NULL}}"/>
                        <input type="hidden" name="level_id" value="{{$for_level->id}}"/>
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
                                            {{ucwords(strtolower($subject->name))}}
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
<div class="" x-data={show:false}>
    <p class="text-xl md:text-lg text-gray-600 font-thin">Add Subjects to level <span @click="show=true" class="cursor-pointer"><b>{{$for_level->name}}</b></span> <span @click="show=true" class="cursor-pointer text-xs fi fi-angle-down"></span></p>
    <div class="absolute rounded bg-white border flex flex-col mt-0 ml-60 shadow-lg" x-show="show" @click.away="show=false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform opacity-0"
        x-transition:enter-end="transform opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform opacity-100"
        x-transition:leave-end="transform opacity-0"
        >
        @foreach ($levels as $level)
        <a class="px-2 text-xs py-2 hover:bg-gray-100" href="{{route('level-subjects.create',['for_level' => $level->id])}}">{{$level->name}}</a>
        @endforeach
    </div>
</div>
@endsection
