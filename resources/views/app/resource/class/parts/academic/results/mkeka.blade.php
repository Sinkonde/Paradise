@section('mkeka')


    <div class="w-full hidden md:flex text-sm">
        @if (count($results))
        <table class="w-full text-xs">
            <thead class="font-semibold">
                <tr>
                <td class="py-2 text-center border">SN</td>
                <td class="py-2 text-left border">Name</td>
                @foreach ($subjects as $subject)
                    <td class="py-2 text-center border" title="{{ucwords(strtolower($subject->level_subject->subject->name))}}">{{ucwords(strtolower($subject->level_subject->subject->short))}}</td>
                @endforeach
                <td class="py-2 text-center border">Total</td>
                <td class="py-2 text-center border">Avg</td>
                <td class="py-2 text-center border">Grade</td>
                <td class="py-2 text-center border">Pos</td>
                </tr>
            </thead>
            <tbody>
                @inject('members', 'App\Models\ClassMember')
                @inject('subject', 'App\Models\Subject')
                @foreach ($results['results'] as $student => $result)
                <tr class="hover:bg-gray-50">
                    <td class="py-1 text-center border">{{$loop->iteration}}</td>
                    @php
                        $st = $members->find($student)->student->particulars
                    @endphp
                    <td class="border">{{ucwords(strtolower($st->first_name.' '.$st->second_name.' '.$st->sur_name))}}</td>

                    @foreach ($subjects as $subject)
                        @foreach ($subject->teacher_subjects as $sub)
                            @if (isset($result['subjects'][$sub->id]))
                                <td class="py-1 text-center border"  title="{{ucwords(strtolower($subject->level_subject->subject->short))}}">
                                    {{ $result['subjects'][$sub->id] }}
                                </td>
                            {{-- @else
                                <td class="border"></td> --}}
                            @endif
                        @endforeach
                    @endforeach

                    <td class="py-1 text-center border">{{$result['total']}}</td>
                    <td class="py-1 text-center border">{{round($result['total']/count($result['subjects']),1)}}</td>
                    <td class="py-1 text-center border">{{setGrade($result['total']/count($result['subjects']))}}</td>
                    <td class="py-1 text-center border">{{$result['position']}}</td>
                </tr>
                @endforeach

                <tr class="py-1 text-center font-semibold">
                    <td></td>
                    <td class="py-1 text-center border bg-gray-100">Average</td>
                    @foreach ($subjects as $subject)
                        @foreach ($subject->teacher_subjects as $sub)
                            @if (isset($results['summary'][$sub->id]))
                                <td class="py-1 text-center border bg-gray-100"  title="{{ucwords(strtolower($subject->level_subject->subject->short))}}">
                                    {{ $results['summary'][$sub->id]['total'] }}
                                </td>
                            @endif
                        @endforeach
                    @endforeach
                    <td class="py-1 text-center border bg-gray-100" title="Total Average">{{$results['total_avg']*count($result['subjects'])}}</td>
                    <td class="py-1 text-center border bg-gray-100" title="Class Average">{{$results['total_avg']}}</td>
                    <td class="py-1 text-center border bg-gray-100" title="Class Grade">{{setGrade($results['total_avg'])}}</td>
                </tr>

                <tr class="py-1 text-center font-semibold">
                    <td></td>
                    <td class="py-1 text-center border  bg-gray-100">Subject Position</td>
                    @foreach ($subjects as $subject)
                        @foreach ($subject->teacher_subjects as $sub)
                        @if (isset($results['summary'][$sub->id]))
                                <td class="py-1 text-center border bg-gray-100"  title="{{ucwords(strtolower($subject->level_subject->subject->short))}}">
                                    {{ $results['summary'][$sub->id]['position'] }}
                                </td>
                            @endif
                        @endforeach
                    @endforeach
                </tr>
            </tbody>
        </table>
        @else
        @inject('class_results', 'App\Models\ClassResult')
            <div class="w-full flex flex-col">
                @foreach ($class_results->where('class_id', $class->id)->get() as $result)
                    <a class="p-1 hover:bg-gray-50 w-full text-lg font-thin" href="{{url()->full().'&exam='.$result->id}}">{{$loop->iteration}}. {{title($result->exam->name)}}</a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
