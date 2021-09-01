@extends('index')
@include('app.resource.student.parts.home.index')
@include('app.resource.student.parts.academic.index')
@include('app.resource.student.parts.timelines.timelines')
@include('app.resource.student.parts.awards.index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 md:px-8">
            {{-- <div class="w-full flex justify-between items-center py-4 md:pb-4 bg-white shadow px-4 rounded mb-5">

                <div class="flex justify-between">
                    <div class="hidden md:block">
                        @foreach ($links as $a_link)
                            <a href="{{route('students.show',['student' => $student->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
                        @endforeach
                    </div>
                    <div class="md:hidden flex flex-col cursor-pointer" x-data={show:false}>
                        <span class="fi fi-nav-icon-list-a text-gray-400 hover:text-gray-600" @click="show=true"></span>
                        <div class="absolute right-3 rounded shadow-lg flex flex-col bg-white mt-8 border" x-show="show" @click.away="show=false">
                            @foreach ($links as $a_link)
                                <a class=" px-2 hover:bg-gray-100 py-1 text-sm" href="{{route('students.show',['student' => $student->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="w-full flex flex-col">
                @switch($link)
                    @case('m')

                        @break
                    @case('ac')

                        @break
                    @case('a')
                        @yield('academic')
                        @break
                    @case('t')
                        @yield('timelines')
                        @break
                    @case('awards')
                        @yield('awards')
                        @break
                    @default
                        @yield('home')
                @endswitch
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class=" font-normal text-lg md:text-lg text-black md:text-gray-600 md:font-semibold overflow-hidden truncate">
    {{ucwords(strtolower($student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name))}}
    @if ($student->current_class->first()->is_dayscholar->first())
        <span class="hidden md:inline-block px-2 py-1 text-sm bg-green-100 text-green-600 rounded-full font-semibold" title="From {{$student->current_class->first()->is_dayscholar->first()->route->name}}">Dayscholar</span>
    @else
        <span class="hidden md:inline-block px-2 py-1 text-sm bg-red-100 text-red-600 rounded-full font-semibold">Boarding</span>
    @endif
</p>
@endsection

@section('navs')
<div class="hidden md:flex justify-between">
    <div class="hidden md:block">
        @foreach ($links as $a_link)
            <a href="{{route('students.show',['student' => $student->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
        @endforeach

        @if ($student->particulars->awards()->count()>0)
            <a href="{{route('students.show',['student' => $student->id, 'link' => 'awards'])}}" class=" @if($a_link['link'] == 'Awards') text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst('Awards')}}</a>
        @endif
    </div>
    <div class="md:hidden flex flex-col cursor-pointer" x-data={show:false}>
        <span class="fi fi-nav-icon-list-a text-gray-400 hover:text-gray-600" @click="show=true"></span>
        <div class="absolute right-3 rounded shadow-lg flex flex-col bg-white mt-8 border" x-show="show" @click.away="show=false">
            @foreach ($links as $a_link)
                <a class=" px-2 hover:bg-gray-100 py-1 text-sm" href="{{route('students.show',['student' => $student->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
            @endforeach
        </div>
    </div>
</div>
@endsection
