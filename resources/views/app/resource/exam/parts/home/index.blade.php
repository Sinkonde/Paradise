@include('app.resource.student.parts.home.student-details')
@include('app.resource.student.parts.home.parent')
@section('home')
<div class="flex flex-col md:flex-row justify-between">
    <div class="w-full md:w-5/12">
        @yield('student')
    </div>

    <div class="w-full md:w-6/12">
        @yield('parent')
    </div>
</div>
@endsection
