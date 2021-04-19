@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full md:w-4/5 lg:w-3/5 flex flex-col py-8 bg-white shadow">
            <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-8 md:pb-8 md:mb-8 border-b">
                <p class="text-xl md:text-2xl text-gray-600 font-thin">Edit {{$academicYear->year}} Academic year</p>
            </div>

            <div class="w-full px-4 md:px-8 flex flex-col">
                <form action="{{route('academic-years.update', ['academic_year' =>$academicYear->id])}}" method="post">
                    @csrf
                    {{method_field('patch')}}
                    <x-form.input classes="w-full mb-4" label="Year" name="year" value="{{$academicYear->year}}" readonly="readonly" />
                    <x-form.input classes="w-full mb-4" label="Comments" name="comments" value="{{$academicYear->comments}}" />
                    <x-form.button color="green" label="Update" />
                </form>
            </div>
        </div>
    </div>
@endsection
