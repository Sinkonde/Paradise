@section('all-results')
<div class="w-full py-4 px-4 flex flex-col">
    <p class="text-xs font-semibold text-black">All Results</p>
    @inject('exams', 'App\Models\Exam')
    @inject('subject', 'App\Models\SubjectTeacher')
    @foreach ($results as $exam =>$result)
        @if ($exams->find($exam))
            <div class="flex justify-between pr-4">
                <p class="text-xl text-gray-400 mt-3 font-thin">{{$loop->iteration}}. {{title($exams->find($exam)->name)}}</p>
                @if (is_connected())
                <a href="{{route('mail.send_results', ['student'=>$student->id, 'exam'=>$exam])}}" class="px-2 py-1 mb-1 rounded-full text-xs text-teal-500 hover:bg-teal-50 mt-3 font-thin">Send to Parent</a>
                @endif
            </div>
            <div class="px-4">
                <table class="text-xs text-gray-700 font-thin w-full">
                    <tr>
                        <th class="border text-center">Subject</th>
                        @foreach ($result['subjects'] as $s => $mark)
                            @if ($subject->find($subject))
                                <td class="border text-center" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{strtoupper($subject->find($s)->class_subject->level_subject->subject->short)}}</td>
                            @endif
                        @endforeach
                        <td class="border text-center" title="Total">TOTAL</td>
                        <td class="border text-center" title="Average">AVG</td>
                        <td class="border text-center" title="Grade">GRD</td>
                        <td class="border text-center" title="Position">POS</td>
                    </tr>

                    <tr>
                        <th class="border text-center">Mark</th>
                        @foreach ($result['subjects'] as $s => $mark)
                            @if ($subject->find($subject))
                                <td class="border text-center font-semibold" title="{{$subject->find($s)->class_subject->level_subject->subject->name}}">{{$mark}}</td>
                            @endif
                        @endforeach
                        <td class="border text-center font-semibold" title="Total">{{$result['total']}}</td>
                        <td class="border text-center font-semibold" title="Average">{{round(array_sum($result['subjects'])/count($result['subjects']),2)}}</td>
                        <td class="border text-center font-semibold" title="Grade">{{setGrade(array_sum($result['subjects'])/count($result['subjects']))}}</td>
                        <td class="border text-center font-semibold" title="Position">{{$result['position']}}</td>
                    </tr>
                 </table>
            </div>
        @endif
    @endforeach

</div>
@endsection
