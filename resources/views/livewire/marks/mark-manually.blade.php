
<div class="w-full">
    <table class="w-full">
        <thead class="text-gray-500 bg-gray-100">
            <tr>
                <th class="py-1 px-2 border" rowspan="2">SN</th>
                <th class="py-1 px-2 border text-left" rowspan="2">Student Name</th>
                <th class="py-1 px-2 border" colspan="{{count($my_subjects)}}">Enter or edit Subject Marks</th>
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
                @php
                    $loop_member = $loop->iteration;
                @endphp
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

                        <td class="border text-center" x-data="{mark:'{{$mark}}'}">
                            {{-- <form wire:submit.prevent="saveMark" id="{{$student_id.'_'.$loop->iteration}}">
                                <input type="hidden" wire:model="student_id" value="{{$student_id}}">
                                <input type="hidden" wire:model="subject_id" value="{{$sub_id}}">
                                <input type="hidden" wire:model="class_result_id" value="{{$class_result}}">
                                <input class="w-full h-100 text-center focus:outline-none"  value="{{$mark}}">
                                {{-- <button>Save<button>
                            </form> --}}

                            <input class="w-full h-100 text-center focus:outline-none"
                                    name="mark"
                                    x-model="mark"
                                    x-on:blur="$wire.saveMark('{{$class_result->id}}','{{$student_id}}','{{$sub_id}}',mark)"
                            />
                        </td>
                    @endforeach
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
