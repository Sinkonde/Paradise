@inject('levels', 'App\Models\Level')
@inject('grades', 'App\Models\Grade')
@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            {{-- {{dd($for_level)}} --}}
            <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                <form action="{{route('fees.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="callback" value="{{route('fees.index',['fees_category'=>request()->fees_category,'year'=>request()->year])}}" />
                    <input type="hidden" name="fees_category_year_id" value="{{$fees_category_year_id}}" />
                    <x-form.input classes="w-full mb-4" label="Name" name="name" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" />
                    <x-form.input classes="w-full mb-4" label="For Level" name="level_id" select="true">
                        <option>All</option>
                        @foreach ($levels->get() as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </x-form.input>
                    <x-form.input classes="w-full mb-4" label="For Grade" name="grade_id" select="true">
                        <option>All</option>
                        @foreach ($grades->get() as $grade)
                            <option value="{{$grade->id}}">Grade {{$grade->name}}</option>
                        @endforeach
                    </x-form.input>
                    <x-form.button color="green" label="Create" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-light">Create New Fees for <span class="font-semibold">{{$title->name}} ({{__('2021')}})</span></span></p>
@endsection
