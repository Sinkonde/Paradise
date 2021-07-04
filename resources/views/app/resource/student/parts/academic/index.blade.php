
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

    <div class="hidden md:block w-full md:w-4/12 lg:w-2/12">
        @yield('academic_links')
    </div>
</div>
@endsection

@if ($link == 'a')
    @section('navs')
    <div class="md:hidden" x-data={showLinks:false}>
        <span class="fi fi-move-h-a px-10 bg-white" @click="showLinks=true"></span>
        <div class="flex bg-white flex-col rounded absolute top-10 w-1/3 right-15 shadow-lg border" x-show="showLinks" @click.away="showLinks=false">
            @foreach ($academic_links as $link)
                <a href="{{route('students.show',['student'=>$student->id,'link'=>'a', 'academic'=>$link])}}" class="text-sm w-full py-1 px-4 @if($academic_active == $link) font-semibold bg-gray-100 @endif">{{$link}}</a>
            @endforeach
        </div>
    </div>
    @endsection
@endif
