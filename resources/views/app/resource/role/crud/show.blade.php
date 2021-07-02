@extends('index')
@section('contents')
    <div class="w-100 flex justify-between m-10">

    </div>
@endsection

@section('title')
<p class="text-black text-lg"><b>{{title($role->name)}}</b> role</p>
@endsection

@section('navs')
<button title="Add users" class="bg-blue-400 px-3 py-1 text-xs rounded text-white">Assign User</button>
@endsection
