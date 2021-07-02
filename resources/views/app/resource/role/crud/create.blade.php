@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-8 bg-white shadow">
            {{-- <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-8 md:pb-8 md:mb-8 border-b">

            </div> --}}

            <div class="w-full px-4 md:px-8 flex flex-col">
                <form action="{{route('levels.store')}}" method="post">
                    @csrf
                    <x-form.input classes="w-full mb-4" label="Level Name" name="name" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" />
                    <x-form.button color="green" label="Create" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-xl md:text-lg text-gray-600 font-thin">Create New Level</p>
@endsection
