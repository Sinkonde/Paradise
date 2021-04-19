@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            {{-- {{dd($for_level)}} --}}
            @if (is_null($for_level))
                <div class="">
                    <p class="py-4 px-8 font-bold text-gray-500">Stream for level?</p>
                    <div class="flex flex-col border-t">
                        @foreach ($levels as $level)
                        <a class="px-8 text-sm py-4 hover:bg-gray-100" href="{{route('streams.create',['for_level' => $level->id])}}">{{$level->name}}</a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b">
                    <p class="text-xl md:text-xl text-gray-600 font-thin">Create new Stream(s) for <b> {{$for_level->name}}</b></p>
                </div>

                <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                    <form action="{{route('streams.store')}}" method="post">
                        @csrf
                        <x-form.input classes="w-full mb-4" label="Name" name="name" />
                        <x-form.input classes="w-full mb-4" label="Description" name="description" />
                        <input type="hidden" name="level_id" value="{{$for_level->id}}" />
                        <x-form.button color="green" label="Create" />

                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

