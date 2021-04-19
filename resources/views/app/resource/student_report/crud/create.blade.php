@extends('index')
@section('contents')
@inject('exams', 'App\Models\Exam')
@inject('academic_year', 'App\Models\AcademicYear')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-4 bg-white shadow">
            @if (count($exams->get()) == 0)
            <div class="w-full flex justify-between items-center px-4 md:px-4 rounded">
                <p class="md:text-lg text-yellow-600 font-thin">No any exam avalable!! Please
                    <a class="hover:underline hover:text-blue-700" href="{{route('exams.create')}}">create one</a>
                 first</p>
            </div>
            @else

            <div class="w-full px-4 md:px-4 flex flex-col">
                <form action="{{route('student-reports.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="callback" value="{{request()->callback}}" />
                    <input type="hidden" name="academic_year" value="{{$academic_year->where('year', date('Y'))->first()->id}}" />
                    <div class="flex flex-col">
                        <div class="w-full md:full">
                            <x-form.input classes="w-full mb-4" label="Name" name="name" />
                        </div>
                        <div class="w-full md:w-full">
                            <x-form.input classes="w-full mb-4" label="Main Exam" name="exam_id" select="true">
                                @foreach ($exams->get() as $exam)
                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </x-form.input>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-full md:w-1/3 md:pr-2">
                            <x-form.input classes="w-full mb-4" label="Closing date" type="date" name="closing_date" />
                        </div>
                        <div class="w-full md:w-1/3 md:px-2">
                            <x-form.input classes="w-full mb-4" label="Boarding Opening Date" type="date" name="board_open" />
                        </div>
                        <div class="w-full md:w-1/3 md:pl-2">
                            <x-form.input classes="w-full mb-4" label="Dayscholar Opening Date" type="date" name="day_open" />
                        </div>
                    </div>

                    <x-form.button color="green" label="Create" />
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('title')
    <p class="md:text-lg text-gray-600 font-thin">Create new Exam</p>
@endsection

