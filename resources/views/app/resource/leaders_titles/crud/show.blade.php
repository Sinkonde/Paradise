@extends('index')
@include('app.resource.class.parts.show.members')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 bg-white shadow rounded">
            <div class="w-full flex justify-between items-center px-2 pb-4 mb-4 md:px-8 md:pb-4 md:mb-4 border-b">
                <p class="text-xl md:text-2xl text-gray-600 font-thin">Class {{$class->grade->name.' '.$class->stream->name}} - ({{$class->academic_year->year}})</p>
                <div class="flex justify-between">
                    @foreach ($links as $a_link)
                        <a href="{{route('classes.show',['class' => $class->id, 'link' => $a_link['link']])}}" class=" @if($a_link['link'] == $link) text-blue-600 font-semibold @endif pl-4 hover:text-blue-900">{{ucfirst($a_link['name'])}}</a>
                    @endforeach
                </div>
            </div>

            <div class="w-full px-4 md:px-8 flex flex-col">
                @switch($link)
                    @case('m')
                        @yield('members')
                        @break
                    @case(2)

                        @break
                    @default

                @endswitch
            </div>
        </div>
    </div>
@endsection
