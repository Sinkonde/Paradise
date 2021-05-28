@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            @if (!$depertments->count())
            <div class="w-full flex justify-between items-center px-4 md:px-4 rounded">
                <p class="md:text-lg text-yellow-600 font-thin"><span class="fi fi-exclamation"></span> You have to <a class="text-blue-600 hover:underline" href="{{route('depertments.create')}}">register depertment</a> first before workers!</p>
            </div>
            @else

            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('workers.store')}}" method="post">
                    @csrf
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/4 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="First Name" name="first_name" />
                        </div>
                        <div class="w-full md:w-1/4 md:px-2">
                            <x-form.input classes="w-full mb-4" label="Second Name" name="second_name" />
                        </div>
                        <div class="w-full md:w-1/4 md:px-2">
                            <x-form.input classes="w-full mb-4" label="Surname" name="sur_name" />
                        </div>
                        <div class="w-full md:w-1/4 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Gender" name="gender" select="true">
                                @foreach ([['name'=>'Male', 'value'=>'m'], ['name'=>'Female', 'value'=>'f']] as $gender)
                                    <option value="{{$gender['value']}}">{{$gender['name']}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Email" name="email" />
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Phone Number" name="phone" />
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Address" name="address" />
                        </div>
                        <div class="w-full md:w-1/2 pl-2">
                            <x-form.input classes="w-full mb-4" label="Depertment" name="depertment_id" select="true">
                                @foreach ($depertments as $depertment)
                                    <option value="{{$depertment->id}}">{{$depertment->name}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <x-form.button color="green" label="Register" />
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('title')
<p class="md:text-lg text-gray-800">Register New Worker</p>
@endsection

