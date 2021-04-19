@include('app.resource.student.parts.home.student-details')
@include('app.resource.student.parts.home.parent')
@include('app.resource.student.parts.home.last_activity')
@include('app.resource.student.parts.home.last_results')
@section('home')
<div class="flex flex-col md:flex-row justify-between">
    <div class="w-full md:w-7/12 lg:w-8/12 mr-2">
        @yield('last-activity')
        @yield('last-results')
    </div>

    <div class="w-full md:w-5/12 lg:w-4/12 md:ml-4">
        @yield('student')
        @yield('parent')
    </div>
</div>
@endsection
