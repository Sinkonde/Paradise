@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">


                <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                    <form action="{{route('religions.store')}}" method="post">
                        @csrf
                        <input hidden classes="w-full mb-4" value="{{request()->callback}}" name="_callback" />
                        <x-form.input classes="w-full mb-4" label="Religion Name" name="name" />
                        <x-form.input classes="w-full mb-4" label="Description" name="description" />

                        <x-form.button color="green" label="Add" />
                    </form>
                </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-xl md:text-xl text-black md:text-gray-600 font-thin">Add New Religion</b></p>
@endsection
