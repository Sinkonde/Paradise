@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            @if (1 != 1)
            <div class="w-full flex justify-between items-center px-4 md:px-4 rounded">
                <p class="md:text-lg text-yellow-600 font-thin">No academic year avalable!!</p>
            </div>
            @else


            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('exams.update', $exam->id)}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <input type="hidden" name="callback" value="{{$callback}}" />
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-3/4 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Name" name="name" value="{{old('name', $exam->name)}}" />
                        </div>
                        <div class="w-full md:w-1/4 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Type" name="type" select="true">
                                @foreach (['public','private'] as $type)
                                    <option @if ($type == $exam->type)
                                        selected = "selected"
                                    @endif>{{$type}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-full md:w-1/4 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Date" name="date" type="date" value="{{old('date', $exam->date)}}" />
                        </div>
                        <div class="w-full md:w-3/4 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Total Marks" name="total_marks" select="true">
                                @foreach ([100, 50] as $total_mark)
                                    <option @if ($total_mark == $exam->total_marks)
                                        selected = "selected"
                                    @endif>{{$total_mark}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <x-form.button color="green" label="Update" />
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('title')
    <p class="md:text-lg text-gray-600 font-thin">Update Exam</p>
@endsection

