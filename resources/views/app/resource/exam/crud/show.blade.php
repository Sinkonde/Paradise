@extends('index')
@include('app.resource.exam.parts.home.details')
@include('app.resource.exam.parts.home.results')
@section('contents')
    <div class="w-100 flex justify-between mt-4">
        <div class="w-1/3 pr-2">
            @yield('details')
        </div>

        <div class="w-2/3 pl-2">
            @yield('results')
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg">{{title($exam->name)}}</p>
@endsection

@section('navs')
<div class="hidden md:flex justify-between md:pr-5">
    @foreach (['About', 'Results'] as $a_link)
        <a href="#" class=" pl-4 hover:text-blue-900">{{ucfirst($a_link)}}</a>
    @endforeach
</div>
@endsection
