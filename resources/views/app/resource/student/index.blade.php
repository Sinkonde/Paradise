@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <livewire:search-student />
    </div>
@endsection

@section('title')
<p class="text-lg md:text-lg text-gray-600 font-thin">All Pupils <span>({{$students->count()}})</span></p>
@endsection

@section('navs')
<form action="{{route('vacations.store')}}" method="post" class="hidden md:flex">
    @csrf
    <input type="hidden" name="{{csrf_token()}}" value="{{csrf_token()}}" />
    <button class="px-2 py-1 hover:border border-teal-600 hover:bg-teal-100 text-teal-600 text-xs rounded-full ml-2">Vacate all</button>
</form>
@endsection
