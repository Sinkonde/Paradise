@extends('index')
@include('app.resource.student.parts.home.index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 bg-white shadow rounded">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-2xl text-gray-600 font-thin">
                    {{ucwords($student->particulars->first_name.' '.$student->particulars->second_name.' '.$student->particulars->sur_name)}}
                </p>
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
            </div>

            <div class="w-full px-4 md:px-8 flex flex-col">
                @switch($link)
                    @case('m')

                        @break
                    @case('a')

                        @break
                    @case('ac')

                        @break
                    @default
                        @yield('home')
                @endswitch
            </div>
        </div>
    </div>
@endsection
