@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col pb-8 bg-white shadow">
            <div class="sticky top-0 w-full flex-col justify-between items-center px-4 pt-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b bg-white">
                <p class="text-xl md:text-2xl text-gray-600 font-thin">Edit <span>{{ucwords(strtolower($worker->guardian->particulars->first_name.' '.$worker->guardian->particulars->sur_name))}}</span> info</p>
                <p class="text-gray-300 leading-6 text-xs">
                    @foreach ($worker->guardian->particulars->phones as $phone)
                        {{$phone->phone}}
                        @if (!$loop->last)
                            {{__(", ")}}
                        @else
                            , <a href="" class="text-blue-200 underline hover:text-blue-400">Edit phones</a>
                        @endif
                    @endforeach
                </p>
            </div>

            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('workers.update', ['worker' => $worker->id, 'user' => $worker->guardian->particulars->id, 'guardian' => $worker->guardian->id, 'depertment'=>$worker->worker_depertments()->orderBy('created_at', 'DESC')->first()->id])}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/4 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="First Name" name="first_name" value="{{$worker->guardian->particulars->first_name}}" />
                        </div>
                        <div class="w-full md:w-1/4 md:px-2">
                            <x-form.input classes="w-full mb-4" label="Second Name" name="second_name" value="{{$worker->guardian->particulars->second_name}}" />
                        </div>
                        <div class="w-full md:w-1/4 md:px-2">
                            <x-form.input classes="w-full mb-4" label="Surname" name="sur_name" value="{{$worker->guardian->particulars->sur_name}}" />
                        </div>
                        <div class="w-full md:w-1/4 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Gender" name="gender" select="true">
                                @foreach ([['name'=>'Male', 'value'=>'m'], ['name'=>'Female', 'value'=>'f']] as $gender)
                                    <option @if ($worker->guardian->particulars->gender == $gender['value'])
                                        selected = "selected"
                                    @endif value="{{$gender['value']}}">{{$gender['name']}}</option>
                                @endforeach
                                <option>All</option>
                            </x-form.input>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Email" name="email" value="{{$worker->guardian->particulars->email}}" />
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Joined" name="joined" value="{{$worker->joined}}" />
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Address" name="address" value="{{$worker->guardian->address}}" />
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Depertment" name="depertment_id" select="true">
                                @foreach ($depertments as $depertment)
                                    <option @if ($worker->worker_depertments()->orderBy('created_at', 'DESC')->first()->depertment_id == $depertment->id)
                                        selected = "selected"
                                    @endif value="{{$depertment->id}}">{{$depertment->name}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <x-form.button color="teal" label="Register" />
                </form>
            </div>
        </div>
    </div>
@endsection

