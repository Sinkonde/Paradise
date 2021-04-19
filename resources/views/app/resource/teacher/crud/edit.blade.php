
@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Create New Title</p>
            </div>

            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('titles.update',$title->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <input type="hidden" name="callback" value="{{$callback ? $callback : NULL}}"/>
                    <x-form.input classes="w-full mb-4" label="Swahili Name" name="sw_name" value="{{$title->sw_name}}" />
                    <x-form.input classes="w-full mb-4" label="English Name" name="en_name" value="{{$title->en_name}}" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" value="{{$title->description}}" />
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection
