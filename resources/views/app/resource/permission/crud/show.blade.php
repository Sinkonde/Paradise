@extends('index')
@section('contents')
    <div class="w-100 flex justify-between m-10">

    </div>

    <button title="Add users" class="md:hidden fixed bottom-5 right-5 inline-block bg-blue-400 px-3 py-1 text-xs rounded text-white">Assign to role</button>
@endsection

@section('title')
<p class="text-black text-lg"><i><b>{{title($permission->name)}}</b></i> permission</p>
@endsection

@section('navs')
<button title="Add users" class="hidden md:inline-block bg-blue-400 px-3 py-1 text-xs rounded text-white">Assign to role</button>
@endsection
