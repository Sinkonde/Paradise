@extends('index')
@section('contents')
@inject('exams', 'App\Models\Exam')
@inject('academic_year', 'App\Models\AcademicYear')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">

            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('student-reports.update', $report->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="callback" value="{{request()->callback}}" />
                    {{method_field('patch')}}
                    <div class="flex flex-col">
                        <div class="w-full md:full">
                            <x-form.input classes="w-full mb-4" label="Name" name="name" value="{{$report->name}}" />
                        </div>
                        <div class="w-full md:w-full">
                            <x-form.input classes="w-full mb-4" label="Main Exam" name="exam_id" select="true">
                                @foreach ($exams->get() as $exam)
                                    <option @if ($report->exam_id == $exam->id)
                                        selected="selected"
                                    @endif value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-full md:w-1/3 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Closing date" type="date" name="closing_date" value="{{$report->closing_date}}" />
                        </div>
                        <div class="w-full md:w-1/3 md:px-2">
                            <x-form.input classes="w-full mb-4" label="Boarding Opening Date" type="date" name="board_open" value="{{$report->board_open}}" />
                        </div>
                        <div class="w-full md:w-1/3 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Dayscholar Opening Date" type="date" name="day_open" value="{{$report->day_open}}" />
                        </div>
                    </div>

                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <p class="md:text-lg md:text-gray-600 md:font-thin">Edit Exam</p>
@endsection

