@extends('layouts.lay')
@include('home.total_students')
@include('app.resource.class.parts.home.members_count_table')
@include('home.info_cards')
@include('home.links')

@section('contents')
<div class="w-100">
    @yield('info-cards')
    <div class="w-full flex flex-col py-4">
            <div class="md:flex justify-between">
                <div class="w-full md:w-2/12">
                    {{-- @yield('linker') --}}
                    {{-- <x-home.info-card /> --}}
                </div>

                <div class="w-full md:w-4/12">
                    {{-- <div class="w-full mb-4">
                        @yield('total_students')
                    </div>
                    <div class="w-full mb-4">
                        @yield('members_count_table')
                    </div> --}}
                </div>
            </div>
    </div>
</div>
@endsection

@section('title')
<p class="text-lg">Home</p>
@endsection
