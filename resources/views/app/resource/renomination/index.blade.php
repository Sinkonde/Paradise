@include('app.resource.renomination.parts.list')
@extends('index')

@php
    $show_religion = true;
@endphp

@section('contents')
    @yield('list')
@endsection

@section('title')
<p class="text-black text-lg">Religions Renominations</p>
@endsection

