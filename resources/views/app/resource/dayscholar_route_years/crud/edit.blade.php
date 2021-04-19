@inject('levels', 'App\Models\Level')
@inject('grades', 'App\Models\Grade')
@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                <form action="{{route('fees.update', ['fee'=>$fees->id])}}" method="post">
                    @csrf
                    <input type="hidden" name="callback" value="{{route('fees.index',['fees_category'=>request()->fees_category,'year'=>request()->year])}}" />
                    {{method_field('patch')}}
                    <x-form.input classes="w-full mb-4" label="Name" name="name" value="{{$fees->name}}" />
                    <x-form.input classes="w-full mb-4" label="Description" name="description" value="{{$fees->description}}" />
                    <x-form.input classes="w-full mb-4" label="For Level" name="level_id" select="true">
                        <option>All</option>
                        @foreach ($levels->get() as $level)
                            <option value="{{$level->id}}" @if ($level->id == $fees->level_id)
                                selected="selected"
                            @endif>{{$level->name}}</option>
                        @endforeach
                    </x-form.input>
                    <x-form.input classes="w-full mb-4" label="For Grade" name="grade_id" select="true">
                        <option>All</option>
                        @foreach ($grades->get() as $grade)
                            <option value="{{$grade->id}}" @if ($grade->id == $fees->grade_id)
                                selected="selected"
                            @endif>Grade {{$grade->name}}</option>
                        @endforeach
                    </x-form.input>
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-light">Update <span class="font-semibold">{{$fees->name}}</span></p>
{{-- of {{$fees->fees_category_year->fees_category->name}} - {{$fees->fees_category_year->academic_year->year}} --}}
@endsection