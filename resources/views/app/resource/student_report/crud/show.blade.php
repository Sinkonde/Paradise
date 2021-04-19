@extends('index')
@include('app.resource.student_report.parts.home.info')
@include('app.resource.student_report.parts.home.reports')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 ">

            <div class="w-full md:px-2 md:flex md:flex-row">
                <div class="w-full md:w-2/3 md:mr-2">
                    @yield('reports')
                </div>

                <div class="w-full md:w-1/3 md:ml-2 mt-4 md:mt-0 flex items-center">
                    @yield('info')
                </div>
            </div>

        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-thin">
    {{ucwords($report->name)}} reports
</p>
@endsection
