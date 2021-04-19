@section('last-results')
<div class="w-full rounded-lg py-4 px-4 flex flex-col shadow-lg border bg-white mb-5">
    <p class="text-xs font-semibold text-black">Latest Results</p>
    @inject('exams', 'App\Models\Exam')
    @inject('subject', 'App\Models\SubjectTeacher')
    @foreach (array_slice($results, 0,1) as $exam =>$result)
        @if ($exams->find($exam))
            <p class="text-xl text-gray-400 mt-3 font-thin">{{title($exams->find($exam)->name)}}</p>
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
             <a href="{{route('students.show',['student'=>$student->id, 'link'=>'a'])}}" class="mt-3 text-xs text-blue-300 hover:text-blue-500 font-thin">View all results >></a>
        @endif
    @endforeach

</div>
@endsection
