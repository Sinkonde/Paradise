@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            {{-- {{dd($for_level)}} --}}
            <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                <form action="{{route('fees-categories.store')}}" method="post">
                    @csrf
                    <x-form.input classes="w-full mb-4" label="Name" name="name" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" />
                    {{-- <x-form.input classes="w-full mb-4" label="For Level" name="level_id" select="true">
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </x-form.input> --}}
                    <x-form.button color="green" label="Create" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <p class="text-lg text-gray-600 font-thin">Create New Fees Category</p>
@endsection
