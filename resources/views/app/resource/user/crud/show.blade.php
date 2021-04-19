@extends('index')
@include('app.resource.user.parts.show.about')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4">

            <div class="w-full flex flex-col">
                @switch(request()->page)
                    @case('staff')
                        @yield('staff')
                        @break

                    @case('teacher')
                        @yield('teacher')
                        @break

                    @case('kids')
                        @yield('kids')
                        @break

                    @default
                        @yield('about')
                        @break
                @endswitch
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg md:text-lg text-gray-600 font-semibold">{{ucwords($user->first_name.' '.$user->second_name.' '.$user->sur_name)}}</p>
@endsection

@section('navs')
<div x-data={showKids:false}  @click.away="showKids=false">
    <a class="mr-4 hover:text-blue-500" href="{{route('users.show', ['user'=>$user->id, 'page'=>'about'])}}">About</a>
    @if ($user->guardian)
        @if ($user->guardian->worker)
            <a class="mr-4 hover:text-blue-500" href="{{route('users.show', ['user'=>$user->id, 'page'=>'staff'])}}">As a Staff</a>
            @if ($user->guardian->worker->teacher)
                <a class="mr-4 hover:text-blue-500" href="{{route('users.show', ['user'=>$user->id, 'page'=>'staff'])}}">As a Teacher</a>
            @endif
        @endif

        @if (count($user->guardian->my_kids) > 0)
            <a class="mr-4 hover:text-blue-500" href="{{route('users.show', ['user'=>$user->id, 'page'=>'kids'])}}" x-on:mouseenter="showKids=true">My kids</a>
            <div class="bg-white border rounded shadow-lg z-50 divide-y px-2 py-2 absolute top-12 right-5" x-show="showKids==true" >
                @foreach ($user->guardian->my_kids as $kids)
                    <a href="{{route('students.show',$kids->students->id)}}" class="py-2 hover:underline hover:text-blue">{{title($kids->students->particulars->first_name.' '.$kids->students->particulars->second_name.' '.$kids->students->particulars->sur_name)}}</a>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection
