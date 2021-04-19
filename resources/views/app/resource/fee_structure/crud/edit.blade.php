@inject('levels', 'App\Models\Level')
@inject('grades', 'App\Models\Grade')
@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            {{-- {{dd($for_level)}} --}}
            <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                <form action="{{route('fees-structures.update', $fee_structure->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <input type="hidden" name="callback" value="{{url()->previous()}}" />
                    <input type="hidden" name="fees_id" value="{{request()->fee}}" />
                    <x-form.input classes="w-full mb-4" label="Amount" name="amount" value="{{$fee_structure->amount}}" />
                    <x-form.input classes="w-full mb-4" label="From" name="from" type="date" value="{{$fee_structure->from}}" />
                    <x-form.input classes="w-full mb-4" label="To" name="to" type="date" value="{{$fee_structure->to}}" />
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-light">Edit Fee Structure</b></p>
@endsection
