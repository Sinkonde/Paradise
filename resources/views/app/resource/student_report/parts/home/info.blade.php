@section('info')
<div class="w-full text-  bg-white shadow-lg rounded">
    <div class="w-full py-3 px-5 border-b flex justify-between">
        <p class="text-lg font-semibold text-gray-500">Report Info</p>
        <a href="{{route('student-reports.edit', $report->id)}}" class="text-blue-500 hover:text-blue-600 hover:undeline">Edit</a>
    </div>
    <div class="px-5 w-full divide-y divide-gray-100">
        <div class="flex flex-col py-2">
            <p class="text-xs text-gray-600">Name</p>
            <p class=" text-gray-400">{{title($report->name)}}</p>
        </div>

        <div class="flex flex-col py-2">
            <p class="text-xs text-gray-600">Main Exam</p>
            <p class=" text-gray-400">{{title($report->main_exam->name)}}</p>
        </div>

        <div class="flex flex-col py-2">
            <p class="text-xs text-gray-600">Closing Date</p>
            <p class=" text-gray-400">{{date("j", strtotime($report->closing_date))}}<sup>{{date("S", strtotime($report->closing_date))}}</sup>{{date(" F, Y", strtotime($report->closing_date))}}</p>
        </div>

        <div class="flex flex-col py-2">
            <p class="text-xs text-gray-600">Boarding Opening date</p>
            <p class=" text-gray-400">{{date("j", strtotime($report->board_open))}}<sup>{{date("S", strtotime($report->board_open))}}</sup>{{date(" F, Y", strtotime($report->board_open))}}</p>
        </div>

        <div class="flex flex-col py-2">
            <p class="text-xs text-gray-600">Dayscholar Opening date</p>
            <p class=" text-gray-400">{{date("j", strtotime($report->day_open))}}<sup>{{date("S", strtotime($report->day_open))}}</sup>{{date(" F, Y", strtotime($report->day_open))}}</p>
        </div>
    </div>
</div>
@endsection
