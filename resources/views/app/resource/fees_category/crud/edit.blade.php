@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-8 bg-white shadow">
            <div class="w-full px-4 md:px-8 flex flex-col">
                <form action="{{route('fees-categories.update',$fees_category->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <x-form.input classes="w-full mb-4" label="Name" name="name" value="{{$fees_category->name}}" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" value="{{$fees_category->description}}" />
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <p class="text-lg text-gray-600 font-thin">Edit {{$fees_category->name}}</p>
@endsection
