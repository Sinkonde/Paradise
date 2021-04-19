@section('reports')
<div class="w-full bg-white  shadow-lg rounded border">
    <div class="w-full py-3 px-2">
        <p class="text-lg font-semibold text-gray-500">Class Reports</p>
    </div>
    <div class="flex w-full">
        <div class="md:w-4/12 flex flex-col divide-y divide-gray-200 bg-gray-100 border-t border-r">
            @foreach ($report->main_exam->class_results as $result)
                <div class="flex justify-between py-1 text-xs hover:bg-gray-50 w-full px-2 @if($result->class->id == request()->class) bg-gray-50 @else text-blue-600 @endif">
                    <a href="{{route('student-reports.show', [$report->id,'class'=>$result->class->id, 'class_result_id'=>$result->id, 'report'=>1])}}" title="Click to view report for this class" class=" @if($result->class->id == request()->class and request()->report == 1) text-gray-500 @else text-blue-600 hover:underline @endif">{{$result->class->grade->name ."-".$result->class->stream->name}} Report</a>
                    @if (request()->class == $result->class->id)
                        <a href="{{route('student-reports.show', [$report->id,'class'=>$result->class->id, 'class_result_id'=>$result->id, 'mkeka'=>1,'exam'=>$report->main_exam->class_results->where('class_id', request()->class)->first()->id])}}" title="Click to view report for this class" class=" @if($result->class->id == request()->class and request()->mkeka == 1) text-gray-500 @else text-blue-600 hover:underline @endif">Mkeka</a>
                    @endif
                </div>
            @endforeach
        </div>


        <div class="md:w-8/12 bg-gray-500 h-3/5 flex flex-grow items-center justify-center text-gray-100 border-t" style="height:300px">
            @if (request()->report == true)
                <iframe src="{{route("student-reports.show",[$report->id, 'report_pdf'=>true, 'class'=>request()->class, 'class_result_id'=>request()->class_result_id])}}" frameborder="1" class="w-full h-full"></iframe>
            @elseif(request()->mkeka == true)
            <iframe src="{{route("student-reports.show",[$report->id, 'mkeka_pdf'=>true, 'class'=>request()->class, 'class_result_id'=>request()->class_result_id, 'exam'=>request()->exam])}}" frameborder="1" class="w-full h-full"></iframe>
            @else
                PDF will be shown here!!
            @endif
        </div>
    </div>
</div>
@endsection
