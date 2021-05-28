@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col mt-4 md:bg-white md:shadow">
            {{-- {{dd($for_level)}} --}}
            @if (is_null($for_level))
                <div class="">
                    <div class="flex flex-col">
                        @foreach ($levels as $level)
                        <a class="px-8 text-sm py-4 hover:bg-gray-100 bg-white rounded shadow md:bg-transparent mb-4 md:shadow-none md:rounded-none" href="{{route('classes.create',['for_level' => $level->id, 'callback' => $callback])}}">{{$level->name}}</a>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b">
                    <p class="text-xl md:text-xl text-gray-600 font-thin">Create new Class for <b> {{$for_level->name}}</b></p>
                </div> --}}

                <div class="w-full px-4 md:px-4 flex flex-col text-sm bg-white py-4 roundend shadow">
                    <form action="{{route('classes.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="callback" value="{{$callback}}" />
                        <x-form.input classes="w-full mb-4" label="Academic Year" name="academic_year_id" select="true">
                            @foreach ($academicYears as $year)
                                <option value="{{$year->id}}">{{$year->year}}</option>
                            @endforeach
                        </x-form.input>
                        <x-form.input classes="w-full mb-4" label="Grade" name="grade_id" select="true">
                            @foreach ($grades as $grade)
                                <option value="{{$grade->id}}">{{$grade->name}} (grade {{$grade->grade}} in {{$grade->level->name}})</option>
                            @endforeach
                        </x-form.input>
                        <x-form.input classes="w-full mb-4" label="Stream" name="stream_id" select="true">
                            @foreach ($streams as $stream)
                                <option value="{{$stream->id}}">{{$stream->name}}</option>
                            @endforeach
                        </x-form.input>
                        <x-form.button color="green" label="Create Class" />
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('title')
@if (is_null($for_level))
    <p class="text-lg text-gray-600 font-thin">Class for?</p>
@else
    <p class="text-lg text-gray-600 font-thin">Create Class for <b> {{$for_level->name}}</b></p>
@endif
@endsection

