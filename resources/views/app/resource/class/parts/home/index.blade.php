@include('app.resource.class.parts.home.members_chart')
@include('app.resource.class.parts.home.members_count_table')
@section('home')
<div class="flex flex-col w-full md:flex-row">
    <div class="w-full md:w-8/12 md:pr-2 mb-4">
        @yield('count-chart')
    </div>
    <div class="w-full md:w-4/12 md:pl-2">
        @yield('members_count_table')
    </div>
</div>
@endsection
