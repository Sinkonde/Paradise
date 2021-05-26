@extends('index')
@section('contents')
    <div class="w-100 flex justify-center">
        <div class="w-full p-4 bg-white shadow">

            <div class="w-full flex justify-between items-center">
                <div class="w-full flex justify-between flex-col">
                    <form action="{{route('students.store')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$callback}}" name="callback" />
                        <div class="student-info p-4 rounded bg-gray-50 border border-gray-200 flex flex-col">
                            <p class="mb-4 text-lg font-thin">Student Info</p>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="First Name" name="sfirst_name" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Second Name" name="ssecond_name" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input label="Sur Name" name="ssur_name" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                            </div>
                            <div class="flex">
                                <x-form.input label="Birth Date" name="dob" classes="w-1/3" />
                                <x-form.input classes="pl-4 w-1/3" label="Gender" name="sgender" select="true">
                                    @foreach ([['name'=>'Male', 'value'=>'m'], ['name'=>'Female', 'value'=>'f']] as $gender)
                                        <option value="{{$gender['value']}}">{{$gender['name']}}</option>
                                    @endforeach
                                </x-form.input>
                                @php
                                    $readonly = isset($dedicated_class) ? 'readonly' : null;
                                @endphp
                                <x-form.input classes="pl-4 w-1/3" label="Class" name="class_id" select="true" readonly={{$readonly}} >
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}" @if (isset($dedicated_class) && $dedicated_class == $class->id)
                                            selected = "selected"
                                        @endif>{{__($class->grade->name.' '.$class->stream->name)}}</option>
                                    @endforeach
                                </x-form.input>
                            </div>
                        </div>
                        <div class="parent-info my-6 p-4 rounded bg-yellow-50 border border-yellow-200 flex flex-col">
                            <p class="mb-4 text-lg font-thin">Parent Info</p>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="First Name" name="first_name" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Second Name" name="second_name" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input label="Sur Name" name="sur_name" classes=" md:pl-4 md:w-1/3 w-full" />
                            </div>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="Email" name="email" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Phone Numbers" name="phone" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input label="Address" name="address" classes=" md:pl-4 md:w-1/3 w-full" />
                            </div>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="Work" name="work" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Location" name="location" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input classes="md:pl-4 md:w-1/3 w-full" label="Relation" name="relation_id" select="true">
                                    @foreach ($relations as $relation)
                                        <option value="{{$relation->id}}">{{$relation->name}}</option>
                                    @endforeach
                                </x-form.input>
                            </div>
                        </div>
                        <x-form.button label="Register" color="green" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-medium">Register New Student</p>
@endsection

@section('navs')
<a href="{{request()->callback}}" class="hidden md:flextext-sm text-red-600 hover:underline font-medium">Cancel</a>
@endsection
