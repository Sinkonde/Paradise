@section('info-cards')
@inject('workers', 'App\Models\Worker')
@inject('subjects', 'App\Models\Subject')
@inject('levels', 'App\Models\Level')
<div class="flex flex-col md:flex-row md:space-x-4 mt-4">
    <a href="{{route('levels.index')}}" class="w-full md:w-1/4 mt-2 md:mt-0">
        <x-home.info-card title="Schools" count="{{count($levels->get())}}" color="red" />
    </a>
    <a href="{{route('students.index')}}" class="w-full md:w-1/4  mt-2 md:mt-0">
        <x-home.info-card title="Students" count="{{$totalStudents['boys']+$totalStudents['girls']}}" color="blue" />
    </a>
    <a href="{{route('workers.index')}}" class="w-full md:w-1/4  mt-2 md:mt-0">
        <x-home.info-card title="Workers" count="{{count($workers->whereTo(null)->get())}}" color="pink" />
    </a>
    <a href="{{route('subjects.index')}}" class="w-full md:w-1/4  mt-2 md:mt-0">
        <x-home.info-card title="Subjects" count="{{count($subjects->get())}}" color="green" />
    </a>
</div>
@endsection
