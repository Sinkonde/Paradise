@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Create New Depertment</p>
            </div>

            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('depertments.store')}}" method="post">
                    @csrf
                    <x-form.input classes="w-full mb-4" label="Route name" name="name" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" />
                    <x-form.button color="green" label="Create" />
                </form>
            </div>
        </div>
    </div>
@endsection
