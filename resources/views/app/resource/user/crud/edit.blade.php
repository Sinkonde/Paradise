
@extends('index')
@section('contents')
<form action="{{route('users.update',$user->id)}}" method="post">
    @csrf
    {{method_field('patch')}}
    <div class="parent-info my-6 p-4 rounded bg-white border border-gray-200 flex flex-col">
        <div class="flex flex-col md:flex-row mb-2">
            <x-form.input label="First Name"  name="first_name" value="{{$user->first_name}}" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
            <x-form.input label="Second Name" name="second_name" value="{{$user->second_name}}" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
            <x-form.input label="Sur Name" name="sur_name" value="{{$user->sur_name}}" classes=" md:pl-4 md:w-1/3 w-full" />
        </div>
        <div class="flex flex-col md:flex-row mb-2">
            <x-form.input label="Email" value="{{$user->email}}" name="email" classes="mb-2 md:mb-0 w-full" />
            {{-- <x-form.input label="Phone Numbers" name="phone" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" /> --}}
            {{-- <x-form.input label="Address" value="{{$student->parents()->first()->guardian->address}}" name="address" classes=" md:pl-4 md:w-1/3 w-full" /> --}}
        </div>
        {{-- <div class="flex flex-col md:flex-row mb-2">
            <x-form.input label="Work" value="{{$student->parents()->first()->guardian->work}}" name="work" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
            <x-form.input label="Location" value="{{$student->parents()->first()->guardian->location}}" name="location" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
            <x-form.input classes="md:pl-4 md:w-1/3 w-full" label="Relation" name="relation_id" select="true">
                @foreach ($relations as $relation)
                    <option @if ($relation->id == $student->parents()->first()->student_guardian_relation_id)
                        selected="selected"
                    @endif value="{{$relation->id}}">{{$relation->name}}</option>
                @endforeach
            </x-form.input>
        </div>--}}
        <button class="bg-blue-500 text-white rounded w-full md:w-1/12 mt-4 py-2 hover:bg-blue-600">Update</button>
    </div>
</form>
@endsection

@section('title')
<p class="text-lg">Edit <span class="font-semibold">{{ucwords($user->first_name.' '.$user->sur_name)}}</span> info</p>
@endsection
