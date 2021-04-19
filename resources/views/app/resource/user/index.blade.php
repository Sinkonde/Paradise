@extends('index')
@section('contents')
    <div class="w-100 flex justify-center">
        <livewire:search-user />
    </div>

    <a href="{{route('users.create',['callback' => route('titles.index')])}}" class="bottom-4 right-4 fixed">
        <button class="rounded-full p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection

@section('title')
    @php
    $title = '';
        switch(request()->view){
            case('parents'):
                $title = 'Parents';
            break;
            case('staff'):
                $title = 'Staff';
            break;
            default:
                $title = 'Users';
            break;
        }
    @endphp
    <p class="text-xl md:text-lg text-gray-600 font-semibold">All {{__($title)}}</p>
@endsection

@section('navs')
    <a href="{{route('users.index',['view'=>'users'])}}" class="mr-3 text-lg hover:underline @if ($title == 'Users')
        text-gray-500 @else  text-blue-500
    @endif">Users</a>
    <a href="{{route('users.index',['view'=>'staff'])}}" class="mr-3  text-lg hover:underline @if ($title == 'Staff')
        text-gray-500 @else text-blue-500
    @endif">Staff</a>
    <a href="{{route('users.index',['view'=>'parents'])}}" class="mr-3  text-lg hover:underline @if ($title == 'Parents')
        text-gray-500 @else text-blue-500
    @endif">Parents</a>
@endsection

