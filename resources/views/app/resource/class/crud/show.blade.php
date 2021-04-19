@extends('index')
@include('app.resource.class.parts.members.index')
@include('app.resource.class.parts.academic.index')
@include('app.resource.class.parts.bursar.index')
@include('app.resource.class.parts.home.index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4">

            <div class="w-full flex flex-col bg-gray-50">
                @switch($link)
                    @case('m')
                        @yield('members')
                        @break
                    @case('a')
                        @yield('academic')
                        @break
                    @case('b')
                        @yield('bursar')
                        @break
                    @default
                        @yield('home')
                @endswitch
            </div>
        </div>
    </div>
@endsection

@section('title')
<div class="flex z-50" x-data={show:false} >
    <span class="text-xl md:text-lg text-gray-500"><b class="cursor-pointer mr-4  font-semibold" @click="show=!show">Class {{$class->grade->name.' '.$class->stream->name}} - ({{$class->academic_year->year}})</b><span @click="show=!show" class="fi fi-angle-down hover:text-gray-600 text-gray-300 cursor-pointer text-sm"></span> </span>
    <div style="z-index: 99999999999 !important" x-show="show" class="absolute bg-white rounded mt-10 flex flex-col border shadow-lg divide-y w-1/5" @click.away="show=false">
        <a class="px-2 py-2 hover:bg-gray-100" href="{{route('classes.index')}}">All</a>
        @foreach ($classes as $clas)
            <a class="@if($clas->id == $class->id) bg-gray-50 @endif px-2 hover:bg-gray-100 text-xs" href="{{route('classes.show',['class' => $clas->id])}}">{{'Class '.ucwords($clas->grade->name.' '.$clas->stream->name)}}</a>
         @endforeach
    </div>
</div>
@endsection

@section('navs')
<div class="hidden md:flex justify-between md:pr-5">
    @foreach ($links as $a_link)
        <a href="{{route('classes.show',['class' => $class->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
    @endforeach
</div>
@endsection
