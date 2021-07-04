@extends('index')
@include('app.resource.class.parts.members.index')
@include('app.resource.class.parts.academic.index')
@include('app.resource.class.parts.bursar.index')
@include('app.resource.class.parts.home.index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4">

            <div class="w-full flex flex-col md:bg-gray-50 bg-gray-100">
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
    <span class="text-lg md:text-lg text-black md:text-gray-500"><b class="cursor-pointer mr-4  md:font-semibold" @click="show=!show">Class {{$class->grade->name.' '.$class->stream->name}} - ({{$class->academic_year->year}})</b><span @click="show=!show" class="fi fi-angle-down hover:text-gray-600 text-gray-800 md:text-gray-300 cursor-pointer text-sm"></span> </span>
    <div style="z-index: 99999999999 !important" x-show="show" class="absolute bg-white rounded mt-10 flex flex-col border shadow-lg divide-y md:w-1/5 w-3/5" @click.away="show=false">
        <a class="px-2 py-2 hover:bg-gray-100" href="{{route('classes.index')}}"><b>All</b></a>
        @foreach ($classes as $clas)
            <a class="@if($clas->id == $class->id) bg-gray-50 @endif px-2 py-2 md:py-1 hover:bg-gray-100 text-md md:text-xs" href="{{route('classes.show',['class' => $clas->id]+request()->except(['exam']))}}">{{'Class '.ucwords($clas->grade->name.' '.$clas->stream->name)}}</a>
         @endforeach
    </div>
</div>
@endsection

@section('navs')
<div class="hidden md:flex justify-between md:pr-5 overflow-hidden truncate">
    @foreach ($links as $a_link)
        <a href="{{route('classes.show',['class' => $class->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
    @endforeach
</div>

<div class="flex md:hidden justify-between text-black" x-data={show:false}>
    <span class="fi fi-move-h-a px-10 bg-white" x-on:click="show=true" @click.away="show=false"></span>
    <div class="absolute -ml-10 flex flex-col w-1/3 right-10 mt-6 shadow-lg border bg-white p-4 rounded" x-show="show">
        @foreach ($links as $a_link)
            <a href="{{route('classes.show',['class' => $class->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif hover:text-blue-900 py-1">{{ucfirst($a_link['name'])}}</a>
        @endforeach
    </div>
</div>
@endsection
