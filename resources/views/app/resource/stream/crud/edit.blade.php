@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Edit Stream {{$stream->name}}</p>
            </div>

            <div class="w-full px-4 flex flex-col">
                <form action="{{route('streams.update', $stream->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <x-form.input classes="w-full mb-4" label="Name" name="name" value="{{$stream->name}}" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" value="{{$stream->description}}" />
                    <x-form.input classes="w-full mb-4" label="For Level" name="level_id" select="true">
                        @foreach ($levels as $level)
                            <option @if ($level->id === $stream->level_id)
                                selected="selected"
                            @endif   value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </x-form.input>
                    <x-form.button color="teal" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection
