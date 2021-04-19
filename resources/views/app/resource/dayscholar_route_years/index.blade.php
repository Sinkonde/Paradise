@extends('index')
@inject('academic_years', 'App\Models\AcademicYear')
@section('contents')


<div class="w-full px-4 md:flex text-sm">
    @if (count($fees_structures) == 0)
        @inject('academic_years', 'App\Models\AcademicYear')
        @foreach ($academic_years->get() as $year)
            <a href="{{route('fees-category-years.index',['year'=>$year->id])}}" title="Show fees structure for this year">
                <div class="py-4 px-8 rounded bg-white border shadow hover:shadow-lg cursor-pointer my-4 flex flex-col">
                    <p class="text-xs text-gray-400 -mb-2">Year</p>
                    <p class=" text-2xl font-semibold text-gray-800">{{$year->year}}</p>
                </div>
            </a>
        @endforeach
    @else
    <div class="md:flex flex-col md:flex-row w-full">
        @foreach ($fees_structures as $fees_structure)
        <div class="bg-white rounded-md w-full md:w-1/3 md:mx-2 border mt-4 flex-grow-0">
            <a href="{{route('fees.index',['fees_category'=> $fees_structure->fees_category->id, 'year'=>$fees_structure->academic_year_id])}}" class="hover:underline hover:text-blue-700">
                <div class="py-3 border-b px-3 text-lg hover:bg-cool-gray-50 font-semibold">{{$fees_structure->fees_category->name}}</div>
            </a>
            <div class="px-4 divide-y divide-gray-100">
            @if (count($fees_structure->fees) != 0)
                @foreach ($fees_structure->fees as $fees)
                <div class="py-2 text-md">
                    <p>{{Str::ucfirst($fees->name)}}</p>
                </div>
                @endforeach
            @endif
            </div>
        </div>
    @endforeach
    </div>
    @endif
</div>

<a class="fixed right-5 bottom-5" href="{{route('fees.create', ['fees_category'=>request()->fees_category, 'year'=>request()->year])}}">
    <x-form.button color='yellow' label='New' />
</a>
@endsection

@section('title')
    @if (count($fees_structures) == 0)
        <p class="text-lg text-gray-600 font-light"><span class="font-semibold">Fees Structure</span></p>
    @else
        <p class="text-lg text-gray-600 font-light"><span class="font-semibold">Fees Structure - {{$academic_years->find(request()->year)->year}}</span></p>
    @endif
@endsection

@section('navs')
    <a href="{{route('fees-category-years.index')}}" class="mr-4 hover:text-blue-800 hover:font-semibold">Years</a>
    <a href="{{route('fees-categories.index')}}" class="mr-4 hover:text-blue-800 hover:font-semibold">Fees Categories</a>
@endsection
