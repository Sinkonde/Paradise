@section('all-results')
<div class="w-full py-4 px-4 flex flex-col">
    <p class="text-xs font-semibold text-black">All Results</p>
    @inject('exams', 'App\Models\Exam')
    @inject('subject', 'App\Models\SubjectTeacher')
    @foreach ($results as $exam =>$result)
        @if ($exams->find($exam))
            <div class="flex justify-between pr-4">
                <p class="md:text-xl md:font-thin  mt-2 mb-2 md:mb-0 md:mt-3 text-gray-700 md:text-gray-400">{{$loop->iteration}}. {{title($exams->find($exam)->name)}}</p>
                @if (is_connected())
                <a href="{{route('mail.send_results', ['student'=>$student->id, 'exam'=>$exam])}}" class="px-2 py-1 mb-1 rounded-full text-xs text-teal-500 hover:bg-teal-50 mt-3 md:font-thin">Send to Parent</a>
                @endif
            </div>
            <div class="px-4">
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
                               <span class="mr-1 text-xs text-black bg-yellow-400 rounded-full px-1 py-1">
                                   {{title($subject->find($s)->class_subject->level_subject->subject->name)}} - {{$mark}}
                               </span>
                           @endif
                       @endforeach

                       <span class="mr-1 text-xs text-black bg-yellow-300 rounded-full px-1 py-1">
                           Total - {{$result['total']}}
                       </span>

                       <span class="mr-1 text-xs text-black bg-yellow-300 rounded-full px-1 py-1">
                           AVG - {{round(array_sum($result['subjects'])/count($result['subjects']),2)}}
                       </span>

                       <span class="mr-1 text-xs text-black bg-yellow-300 rounded-full px-1 py-1">
                           GRD - {{setGrade(array_sum($result['subjects'])/count($result['subjects']))}}
                       </span>

                       <span class="mr-1 text-xs text-black bg-yellow-300 rounded-full px-1 py-1">
                           POS - {{$result['position']}}
                       </span>
                    </p>
                </div>
            </div>
        @endif
    @endforeach

</div>
@endsection
