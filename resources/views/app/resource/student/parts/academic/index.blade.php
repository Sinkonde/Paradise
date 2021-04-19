
@include('app.resource.student.parts.academic.academic_links')
@include('app.resource.student.parts.academic.all_results')
@include('app.resource.student.parts.home.last_results')
@section('academic')
<div class="flex flex-col md:flex-row justify-between -mt-5 bg-white shadow border">
    <div class="w-full md:w-8/12 lg:w-10/12">
        @switch($academic)
            @case('Progress')

                @break
            @default
                @yield('all-results')
                @break

        @endswitch
    </div>

    <div class="w-full md:w-4/12 lg:w-2/12">
        @yield('academic_links')
    </div>
</div>
@endsection
