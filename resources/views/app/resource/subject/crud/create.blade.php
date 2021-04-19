@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Create New Subject</p>
            </div>

            {{-- @if (count($levels) == 0)
            <div class="w-full px-4 md:px-4 text-yellow-500 leading text-xl font-thin">
                You can't create subject, because there is no any level yet. Either <a class="text-blue-500 hover:text-blue-700 hover:underline" href="{{route('levels.create')}}">create level</a> first or <a class="text-red-500 hover:text-red-700 hover:underline" href="">cancel</a>
            </div>
            @else --}}
            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('subjects.store')}}" method="post">
                    @csrf
                    <div class="flex">
                        <div class="w-2/4 pr-2">
                            <x-form.input classes="w-full mb-4" label="Name in English" name="name" />
                        </div>
                        <div class="w-2/4 pl-2">
                            <x-form.input classes="w-full mb-4" label="Name in Swahili" name="sw_name" />
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-2/4 pr-2">
                            <x-form.input classes="w-full mb-4" label="Short Name" name="short" />
                        </div>
                        <div class="w-2/4 pl-2">
                            <x-form.input classes="w-full mb-4" label="Description" name="description" />
                        </div>
                    </div>
                    <x-form.button color="green" label="Create" />
                </form>
            </div>
            {{-- @endif --}}
        </div>
    </div>
@endsection
