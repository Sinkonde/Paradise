
@section('details')
<div class="w-full bg-white rounded-lg divide-y  border font-thin">
    <div class="w-full flex justify-between p-4 items-center">
        <p class="text-lg mb-1 font-semibold">Description</p>
        <a href="{{route('exams.edit', ['exam'=>$exam->id, 'callback'=>route('exams.show',$exam->id)])}}" class="text-xs text-blue-500 hover:underline">Edit</a>
    </div>

    <div class="w-full flex flex-col p-4">
        <p class="text-xs mb-1 text-gray-400">Exam Name</p>
        <p class="text-lg">{{title($exam->name)}}</p>
    </div>

    <div class="w-full flex flex-col  p-4">
        <p class="text-xs mb-1 text-gray-400">Exam Type</p>
        <p class="text-lg">{{title($exam->type)}}</p>
    </div>

    <div class="w-full flex flex-col  p-4">
        <p class="text-xs mb-1 text-gray-400">Exam Date</p>
        <p class="text-lg">{{title(date('jS M, Y', strtotime($exam->date)))}}</p>
    </div>

    <div class="w-full flex flex-col  p-4">
        <p class="text-xs mb-1 text-gray-400">Total Marks</p>
        <p class="text-lg">{{$exam->total_marks}}</p>
    </div>
</div>
@endsection
