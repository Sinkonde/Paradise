@inject('levels', 'App\Models\Level')
@inject('grades', 'App\Models\Grade')
@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            {{-- {{dd($for_level)}} --}}
            <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                <form action="{{route('fees-structures.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="callback" value="{{url()->previous()}}" />
                    <input type="hidden" name="fees_id" value="{{request()->fee}}" />
                    <input type="hidden" name="model" value="fee" />
                    <x-form.input classes="w-full mb-4" label="Amount" name="amount" />
                    <x-form.input classes="w-full mb-4" label="From" name="from" type="date" />
                    <x-form.input classes="w-full mb-4" label="To" name="to" type="date" />
                    <x-form.button color="green" label="Create" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-light">Add amount and period for <b>{{$fees_year->fees_category->name}} - {{$fees_year->academic_year->year}}</b></p>
@endsection
