@section('subjects')
@inject('teachers', 'App\Models\Teacher')
<div class="w-100 flex justify-center">
    <div class="w-full flex flex-col bg-white">
        <div class="w-full flex justify-between items-center p-4 border-b border-gray-200 mb-4">
            <p class="text-lg text-gray-600 font-thin">Subjects <span>({{$subjects->count()}} Subjects)</span></p>
            <a class="absolute right-4 bottom-4" href="{{route('class-subjects.create',['level' => $class->grade->level->id, 'class'=>$class->id, 'callback' => route('classes.show', ['class'=>$class->id, 'link'=>'a'])])}}">
                <x-form.button color='yellow' label='New' />
            </a>
        </div>

        <div class="w-full hidden md:flex text-xs">
            @if (count($subjects) == 0)
                <p class="text-sm font-semibold">No any subject so far!</p>
            @else
            <table class="w-full text-sm">
                <thead>
                    <tr class=" border-b border-gray-100">
                        <th class="pb-2">SN</th>
                        <th class="pb-2 text-left">Name</th>
                        <th class="pb-2 text-left">Teacher</th>
                        {{-- <th class="pb-2 text-left">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 text-center">{{$loop->iteration}}.</td>
                            <td class="py-2">{{ucwords(strtolower($subject->level_subject->subject->name))}}</td>
                            <td class="py-2" x-data="{show{{$loop->iteration}}:false}">
                                @php
                                    $t = $subject->teacher_subjects()->where('to',null)->orderBy('created_at', 'desc')->first();
                                @endphp
                                @if ($t)
                                    @php
                                        $t = $t->teacher->worker->guardian->particulars;
                                    @endphp
                                    <div class="w-full flex justify-between">
                                        <p>{{$t->gender == 'm' ? 'Mr. ': 'Madam '}} {{ucwords(strtolower($t->sur_name.' '.$t->first_name))}}</p>
                                        <div class="flex flex-row">
                                            <a class="tezt-xs text-blue-500 hover:underline cursor-pointer" @click="show{{$loop->iteration}}=true">Change</a>
                                        </div>
                                    </div>

                                @else
                                    <a class="text-xs bg-red-100 border-red-400 text-red-400 rounded-full px-2 cursor-pointer" @click="show{{$loop->iteration}}=true">Assign</a>
                                @endif
                                    <div class="w-2/12 p-2 rounded bg-white absolute z-20 border shadow" x-show="show{{$loop->iteration}}" @click.away="show{{$loop->iteration}}=false">

                                        <form method="post" action="{{route('subject-teachers.store')}}">
                                            @csrf
                                            <p class="text-sm mb-2 text-gray-500 font-thin">Choose Teacher for <b>{{strtoupper($subject->level_subject->subject->short)}}</b></p>
                                            <input type="hidden" value="{{$subject->id}}" name="subject_id" />
                                            <select class="w-full font-thin border rounded bg-gray-50 mb-2 text-gray-500 focus:text-gray-700 text-xs" name="teacher_id">
                                                @foreach ($teachers->all() as $teacher)
                                                @php
                                                    $te = $teacher->worker->guardian->particulars;
                                                @endphp
                                                    <option value="{{$teacher->id}}">@if ($te->gender == 'm')
                                                    {{'Mr. '}} @else {{'Madam '}}
                                                    @endif{{ucwords(strtolower($te->first_name.' '.$te->second_name.' '.$te->sur_name))}}</option>
                                                @endforeach
                                                <option value="_w">Without teacher</option>
                                            </select>
                                            <button class="text-xs w-full rounded bg-blue-300 hover:bg-blue-200 text-white">Okay</button>
                                        </form>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
