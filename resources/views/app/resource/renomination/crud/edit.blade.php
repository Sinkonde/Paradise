@extends('index')
@section('contents')
    <div class="w-100 flex justify-center">
        <div class="w-full p-4 bg-white shadow">
            <div class="w-full block flex justify-between items-center mb-5 border-b border-gray-200 pb-5">
                <p class="text-2xl text-gray-600 font-thin">Edit <span>{{$student->particulars->first_name.' '.$student->particulars->sur_name}}</span> info</p>
                <a href="{{route('students.index')}}">
                    <x-form.button color='red' label='Cancel' />
                </a>
            </div>


            <div class="w-full block flex justify-between items-center">
                <div class="w-full flex justify-between flex-col">
                    <form action="{{route('students.update', ['student'=>$student->id, 'u_s' => $student->particulars->id, 'u_g' => $student->parents()->first()->guardian->particulars, 'guardian' => $student->parents()->first()->guardian->id, 'relate' => $student->parents()->first()->id, 'class'=>$student->class_member_in()->orderBy('created_at', 'DESC')->first()->id])}}" method="post">
                        @csrf
                        {{method_field('patch')}}
                        <input type="hidden" value="{{$callback}}" name="callback" />
                        <div class="student-info p-4 rounded bg-gray-50 border border-gray-200 flex flex-col">
                            <p class="mb-4 text-lg font-thin">Student Info</p>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="First Name" name="sfirst_name" value="{{$student->particulars->first_name}}" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Second Name" name="ssecond_name" value="{{$student->particulars->second_name}}" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input label="Sur Name" name="ssur_name" value="{{$student->particulars->sur_name}}" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                            </div>
                            <div class="flex">
                                <x-form.input label="Birth Date" name="dob" value="{{$student->dob}}" classes="w-1/3" />
                                <x-form.input classes="pl-4 w-1/3" label="Gender" name="sgender" select="true">
                                    @foreach ([['name'=>'Male', 'value'=>'m'], ['name'=>'Female', 'value'=>'f']] as $gender)
                                        <option @if ($student->particulars->gender == $gender['value'])
                                            selected="selected"
                                        @endif value="{{$gender['value']}}">{{$gender['name']}}</option>
                                    @endforeach
                                </x-form.input>
                                <x-form.input classes="pl-4 w-1/3" label="Class" name="class_id" select="true">
                                    @foreach ($classes as $class)
                                        <option @if ($student->class_member_in()->orderBy('created_at', 'DESC')->first()->class->id == $class->id)
                                            selected="selected"
                                        @endif value="{{$class->id}}">{{__($class->grade->name.' '.$class->stream->name)}}</option>
                                    @endforeach
                                </x-form.input>
                            </div>
                        </div>
                        <div class="parent-info my-6 p-4 rounded bg-yellow-50 border border-yellow-200 flex flex-col">
                            <div class="mb-4 text-lg font-thin flex justify-between">
                                <p>Parent Info</p>
                                <p class="text-xs text-white p-1">
                                    @foreach ($student->parents()->first()->guardian->particulars->phones as $phone)
                                        <span class="bg-blue-300 rounded px-1">{{$phone->phone}}</span>
                                        @if (!$loop->last)
                                            {{-- {{__(", ")}} --}}
                                        @else
                                            , <a title="Edit phone numbers" href="" class="hover:bg-yellow-400 text-white bg-yellow-300 rounded px-2">Edit</a>
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="First Name"  name="first_name" value="{{$student->parents()->first()->guardian->particulars->first_name}}" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Second Name" name="second_name" value="{{$student->parents()->first()->guardian->particulars->second_name}}" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input label="Sur Name" name="sur_name" value="{{$student->parents()->first()->guardian->particulars->sur_name}}" classes=" md:pl-4 md:w-1/3 w-full" />
                            </div>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="Email" value="{{$student->parents()->first()->guardian->particulars->email}}" name="email" classes="mb-2 md:mb-0 md:w-2/3 w-full" />
                                {{-- <x-form.input label="Phone Numbers" name="phone" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" /> --}}
                                <x-form.input label="Address" value="{{$student->parents()->first()->guardian->address}}" name="address" classes=" md:pl-4 md:w-1/3 w-full" />
                            </div>
                            <div class="flex flex-col md:flex-row mb-2">
                                <x-form.input label="Work" value="{{$student->parents()->first()->guardian->work}}" name="work" classes="mb-2 md:mb-0 md:w-1/3 w-full" />
                                <x-form.input label="Location" value="{{$student->parents()->first()->guardian->location}}" name="location" classes="mb-2 md:mb-0 md:pl-4 md:w-1/3 w-full" />
                                <x-form.input classes="md:pl-4 md:w-1/3 w-full" label="Relation" name="relation_id" select="true">
                                    @foreach ($relations as $relation)
                                        <option @if ($relation->id == $student->parents()->first()->student_guardian_relation_id)
                                            selected="selected"
                                        @endif value="{{$relation->id}}">{{$relation->name}}</option>
                                    @endforeach
                                </x-form.input>
                            </div>
                        </div>
                        <x-form.button label="Update" color="green" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
