@php
    $my_subjects = [];
    foreach($subjects as $sub){
        if ($sub->class_subject->class_id == request()->class) {
            array_push($my_subjects, $sub->class_subject);
        }
    }
@endphp
@section('header')
<div class="w-full">
    <table class="w-full">
        <thead class="text-gray-500 bg-gray-100">
            <tr>
                <th class="py-1 px-2 border" rowspan="2">SN</th>
                <th class="py-1 px-2 border text-left" rowspan="2">Student Name</th>
                <th class="py-1 px-2 border" colspan="{{count($my_subjects)}}">Enter or edit Subject Marks</th>
                {{-- {{dd($subjects)}} --}}
            </tr>
            <tr>
                @foreach ($my_subjects as $subject)
                    <th class="py-1 px-2 border">{{strtoupper($subject->level_subject->subject->short)}}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @inject('marks', 'App\Models\Mark')
            @if ($members)
                @foreach ($members as $member)
                <tr class="hover:bg-red-50">
                    <td class="text-center border py-1 px-2">{{$loop->iteration}}</td>
                    <td class="border px-2">{{ucwords(strtolower($member->first_name.' '.$member->sur_name))}}</td>
                    @foreach ($my_subjects as $subject)
                        @php
                            $sub_id = $subject->teacher_subjects->where('teacher_id',$teacher->id)->first()->id;
                            $student_id = $member->student->current_class->first()->id;
                            $mark = $marks->where('subject_id',$sub_id)->whereStudentId($student_id)->first();
                            $mark = $mark?$mark->mark:null;
                        @endphp

                        <td class="border text-center" contenteditable="true">

                            <span class="w-full h-full">{{$mark}}</span>
                        </td>
                    @endforeach
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
