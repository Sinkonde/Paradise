@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-8 bg-white shadow">
            <div class="w-full flex justify-between px-4 md:px-8 text-lg font-thin mb-6">
                This phone number belongs to {{title($phone->user->first_name.' '.$phone->user->sur_name)}}
            </div>
            <div class="w-full px-4 md:px-8 flex flex-col">
                <form action="{{route('user-phones.update', $phone->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <x-form.input value="{{$phone->phone}}" classes="w-full mb-4" label="Phone" name="phone" />
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600">Edit <span class="font-semibold">{{$phone->phone}}</span> phone number</p>
@endsection
