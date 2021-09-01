@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">


                <div class="w-full px-4 md:px-4 flex flex-col text-sm">
                    <form action="{{route('renominations.store')}}" method="post">
                        @csrf
                        <input hidden classes="w-full mb-4" value="{{request()->callback}}" name="_callback" />
                        <x-form.input classes="w-full mb-4" label="Name" name="name" />
                        <x-form.input classes="w-full mb-4" label="Description" name="description" />
                        <x-form.input classes="w-full mb-4" label="Choose Religion" name="religion_id" select="true">
                            @foreach ($religions as $religion)
                                <option @if ($religion->id == request()->religion_id)
                                    selected @endif value="{{$religion->id}}">{{$religion->name}}</option>
                            @endforeach
                        </x-form.input>

                        @if (count($religions)>0)
                        <x-form.button color="green" label="Add" />
                        @endif


                    </form>
                    @if (count($religions)==0)
                        <a href="{{route('religions.create')}}"><x-form.button color="red" label="Please, first add at least one religion" /></a>
                    @endif
                </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-xl md:text-xl text-black md:text-gray-600 font-thin">Add New Renominations</b></p>
@endsection
