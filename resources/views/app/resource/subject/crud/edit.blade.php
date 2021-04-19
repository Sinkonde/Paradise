@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-xl text-gray-600 font-thin">Edit <span class="font-semibold">{{$subject->name}}</span> Subject</p>
            </div>

            @if (is_null($subject))
            @else
            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('subjects.update',$subject->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <div class="flex">
                        <div class="w-2/4 pr-2">
                            <x-form.input classes="w-full mb-4" label="Subject Name" name="name" value="{{$subject->name}}" />
                        </div>
                        <div class="w-2/4 pl-2">
                            <x-form.input classes="w-full mb-4" label="Swahili Name" name="sw_name" value="{{$subject->sw_name}}" />
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-2/4 pr-2">
                            <x-form.input classes="w-full mb-4" label="Short Name" name="short" value="{{$subject->short}}" />
                        </div>
                        <div class="w-2/4 pl-2">
                            <x-form.input classes="w-full mb-4" label="Description" name="description" value="{{$subject->description}}" />
                        </div>
                    </div>

                    <x-form.button color="blue" label="Update" />
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection
