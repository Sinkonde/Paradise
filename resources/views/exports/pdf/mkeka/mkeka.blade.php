@section('mkeka')


    <div class="w-full hidden md:flex text-sm">
        @if (count($results))
        <table class="w-full text-xs" style="width:100%; font-size:0.75em; border-collapse:collapse">
            <thead style="font-weight: 600; text-align:left">
                <tr>
                <td style="padding:0.25em; text-align:center; border:1px solid black">SN</td>
                <td style="padding:0.25em; text-align:center; border:1px solid black; text-align:left">Name</td>
                @foreach ($subjects as $subject)
                    <td  style="padding:0.5em; text-align:center; border:1px solid black" title="{{ucwords(strtolower($subject->level_subject->subject->name))}}">{{ucwords(strtolower($subject->level_subject->subject->short))}}</td>
                @endforeach
                <td  style="padding:0.25em; text-align:center; border:1px solid black">Total</td>
                <td  style="padding:0.25em; text-align:center; border:1px solid black">Avg</td>
                <td  style="padding:0.25em; text-align:center; border:1px solid black">Grade</td>
                <td  style="padding:0.25em; text-align:center; border:1px solid black">Pos</td>
                </tr>
            </thead>
            <tbody>
                @inject('members', 'App\Models\ClassMember')
                @inject('subject', 'App\Models\Subject')
                @foreach ($results['results'] as $student => $result)
                <tr style="padding:0.25em; text-align:center; border:1px solid black">
                    <td style="padding:0.25em; text-align:center; border:1px solid black;">{{$loop->iteration}}</td>
                    @php
                        $st = $members->find($student)->student->particulars
                    @endphp
                    <td style="padding:0.25em; text-align:left; border:1px solid black">{{ucwords(strtolower($st->first_name.' '.$st->second_name.' '.$st->sur_name))}}</td>

                    @foreach ($subjects as $subject)
                        @foreach ($subject->teacher_subjects as $sub)
                            @if (isset($result['subjects'][$sub->id]))
                                <td style="padding:0.25em; text-align:center; border:1px solid black"  title="{{ucwords(strtolower($subject->level_subject->subject->short))}}">
                                    {{ $result['subjects'][$sub->id] }}
                                </td>
                            @endif
                        @endforeach
                    @endforeach

                    <td  style="padding:0.25em; text-align:center; border:1px solid black">{{$result['total']}}</td>
                    <td  style="padding:0.25em; text-align:center; border:1px solid black">{{round($result['total']/count($result['subjects']),1)}}</td>
                    <td  style="padding:0.25em; text-align:center; border:1px solid black">{{setGrade($result['total']/count($result['subjects']))}}</td>
                    <td  style="padding:0.25em; text-align:center; border:1px solid black">{{$result['position']}}</td>
                </tr>
                @endforeach

                <tr class="py-1 text-center font-semibold">
                    <td></td>
                    <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7">Average</td>
                    @foreach ($subjects as $subject)
                        @foreach ($subject->teacher_subjects as $sub)
                            @if (isset($results['summary'][$sub->id]))
                                <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7"  title="{{ucwords(strtolower($subject->level_subject->subject->short))}}">
                                    {{ $results['summary'][$sub->id]['total'] }}
                                </td>
                            @endif
                        @endforeach
                    @endforeach
                    <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7" title="Total Average">{{$results['total_avg']*count($result['subjects'])}}</td>
                    <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7" title="Class Average">{{$results['total_avg']}}</td>
                    <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7" title="Class Grade">{{setGrade($results['total_avg'])}}</td>
                    <td></td>
                </tr>

                <tr class="py-1 text-center font-semibold">
                    <td></td>
                    <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7">Subject Position</td>
                    @foreach ($subjects as $subject)
                        @foreach ($subject->teacher_subjects as $sub)
                        @if (isset($results['summary'][$sub->id]))
                                <td style="padding:0.25em; text-align:center; border:1px solid black; background-color:#f4f5f7"  title="{{ucwords(strtolower($subject->level_subject->subject->short))}}">
                                    {{ $results['summary'][$sub->id]['position'] }}
                                </td>
                            @endif
                        @endforeach
                    @endforeach
                    <td></td><td></td><td></td>
                </tr>
            </tbody>
        </table>
        @else
        @endif
    </div>
@endsection
