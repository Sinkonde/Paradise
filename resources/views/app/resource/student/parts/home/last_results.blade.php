@section('last-results')
<div class="w-full rounded-lg py-4 px-4 flex flex-col shadow-lg border bg-white mb-5">
    <p class="text-xs font-semibold text-gray-400 md:text-black">Latest Results</p>
    @inject('exams', 'App\Models\Exam')
    @inject('subject', 'App\Models\SubjectTeacher')
    @foreach (array_slice($results, 0,1) as $exam =>$result)
        @if ($exams->find($exam))
            <p class="md:text-xl md:font-thin  mt-2 mb-2 md:mb-0 md:mt-3 text-gray-700 md:text-gray-400">{{title($exams->find($exam)->name)}}</p>
            <table class="hidden md:table text-xs text-gray-700 font-thin w-full">
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
             <div class="md:hidden flex flex-row">
                 <p class="font-medium">
                @foreach ($result['subjects'] as $s => $mark)
                        @if ($subject->find($subject))
                            <span class="mr-1 text-xs text-black bg-yellow-200 rounded-full px-1 py-1">
                                {{ucfirst($subject->find($s)->class_subject->level_subject->subject->name)}} - {{$mark}}
                            </span>
                        @endif
                    @endforeach

                    <span class="mr-1 text-xs text-black bg-yellow-400 rounded-full px-1 py-1">
                        Total - {{$result['total']}}
                    </span>

                    <span class="mr-1 text-xs text-black bg-yellow-400 rounded-full px-1 py-1">
                        AVG - {{round(array_sum($result['subjects'])/count($result['subjects']),2)}}
                    </span>

                    <span class="mr-1 text-xs text-black bg-yellow-400 rounded-full px-1 py-1">
                        GRD - {{setGrade(array_sum($result['subjects'])/count($result['subjects']))}}
                    </span>

                    <span class="mr-1 text-xs text-black bg-yellow-400 rounded-full px-1 py-1">
                        POS - {{$result['position']}}
                    </span>
                 </p>
             </div>
             <a href="{{route('students.show',['student'=>$student->id, 'link'=>'a'])}}" class="text-xs mt-2 md:mt-3 md:text-xs text-blue-500 md:text-blue-300 md:hover:text-blue-500 font-semibold md:font-thin">View all results >></a>
        @endif
    @endforeach

</div>
@endsection
