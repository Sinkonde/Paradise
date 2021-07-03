@section('last-activity')
<div class="w-full rounded-lg py-4 px-4 flex flex-col shadow-lg border mb-5 bg-white">
    <p class="text-xs font-semibold text-gray-400 md:text-black">Last Activity</p>
    @if ($student->timelines()->orderBy('date','desc')->first())
    <p class="text-sm md:text-xl md:text-gray-400 md:font-thin mt-2 md:mt-3">{{$student->timelines()->orderBy('date','desc')->first()->description}}</p>
    @else
    <p class="md:text-xl md:text-gray-400 md:font-thin md:mt-3 mt-2  italic md:not-italic">No any activity so far</p>
    @endif
    <a href="{{route('students.show',['student'=>$student->id, 'link'=>'t'])}}" class="text-xs mt-2 md:mt-3 md:text-xs text-blue-400 md:text-blue-300 md:hover:text-blue-500 font-thin">View all activities >></a>
</div>
@endsection
