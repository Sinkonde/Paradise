@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-8 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-8 md:pb-8 md:mb-8 border-b">
                <p class="text-xl md:text-2xl text-gray-600 font-thin">Edit grade {{$grade->name}}</p>
            </div>

            <div class="w-full px-4 md:px-8 flex flex-col">
                <form action="{{route('grades.update',$grade->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <x-form.input classes="w-full mb-4" label="Name" name="name" value="{{$grade->name}}" />
                    <x-form.input classes="w-full mb-4" label="Grade" name="grade" value="{{$grade->grade}}" readonly="readonly" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" value="{{$grade->description}}" />
                    <x-form.input classes="w-full mb-4" label="For Level" name="level_id" select="true">
                        @foreach ($levels as $level)
                            <option @if ($grade->level_id == $level->id)
                                selected="selected"
                            @endif value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </x-form.input>
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection
