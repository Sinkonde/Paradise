@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center mt-5">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-8 bg-white shadow">
            {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-8 md:pb-8 md:mb-8 border-b">

            </div> --}}

            <div class="w-full px-4 md:px-8 flex flex-col">
                <form action="{{route('routes.update', $route->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <x-form.input value="{{title($route->name)}}" classes="w-full mb-4" label="Name" name="name" />
                    <x-form.input value="{{$route->description}}" classes="w-full mb-4" label="Description" name="description" />
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-thin">Edit <span class="font-semibold">{{title($route->name)}}</span> Route</p>
@endsection
