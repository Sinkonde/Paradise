@section('last-activity')
<div class="w-full rounded-lg py-4 px-4 flex flex-col shadow-lg border mb-5 bg-white">
    <p class="text-xs font-semibold text-black">Last Activity</p>
    @if ($student->timelines()->orderBy('date','desc')->first())
    <p class="text-xl text-gray-400 font-thin mt-3">{{$student->timelines()->orderBy('date','desc')->first()->description}}</p>
    @else
    <p class="text-xl text-gray-400 font-thin mt-3">No any activity so far</p>
    @endif
    <a href="{{route('students.show',['student'=>$student->id, 'link'=>'t'])}}" class="mt-3 text-xs text-blue-300 hover:text-blue-500 font-thin">View all activities >></a>
</div>
@endsection
