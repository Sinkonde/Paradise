@extends('index')
@include('app.resource.mark.parts.manual_entry')
@section('contents')
    <div class="w-100 flex justify-center">
        <div class="w-full @if(request()->mode != 'manually')md:w-1/2 py-4 bg-white shadow-lg rounded-lg @endif">
            @if ($exam)
                @if ($class)
                    @if (!request()->mode)
                    <p class="px-4 pb-4 text-center text-lg">How you add those marks?</p>
                    <div class="px-4 text-2xl space-x-6 flex justify-around">
                        <a title="Through" href="{{route('marks.create',['class'=>request()->class, 'exam'=>request()->exam, 'mode'=>'import'])}}" class="w-full md:w-1/2">
                            <div class="flex items-center space-x-4 bg-gray-50 rounded px-5 hover:bg-gray-100 hover:shadow">
                                <span class="text-4xl"><span class="fi fi-cloud-up"></span></span>
                                <p>Import</p>
                            </div>
                        </a>
                        <a title="Or add them
                        " href="{{route('marks.create',['class'=>request()->class, 'exam'=>request()->exam, 'mode'=>'manually'])}}" class="w-full md:w-1/2">
                            <div class="flex items-center space-x-4 bg-gray-50 rounded px-5 hover:bg-gray-100 hover:shadow">
                                <span class="text-4xl"><span class="fi fi-preview"></span></span>
                                <p>Manually</p>
                            </div>
                        </a>
                    </div>
                    @else
                        @if (request()->mode == 'import')
                        <div class="w-full flex flex-col justify-center items-center mb-3 pb-3 border-b border-gray-200">
                            <p class="text-xl text-gray-600 font-thin">
                                Import Marks for class
                                <b><a class="hover:text-blue-600" href="{{route('classes.show',['class'=>$class->id, 'link'=>'m'])}}">{{$class->grade->name.' '.$class->stream->name}}</a></b>
                            </p>
                            <p class="text-sm text-gray-300 font-thin">{{ucfirst($exam->name)}}</p>
                        </div>


                        <div class="w-full flex justify-between items-center">
                            <div class="w-full flex justify-center flex-col">
                                <form action="{{route('marks.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$callback}}" name="callback" />
                                    <input type="hidden" value="_import" name="_import" />
                                    <input type="hidden" value="{{$class->id}}" name="class_id" />
                                    <input type="hidden" value="{{$exam->id}}" name="exam" />
                                    <div class="student-info p-4 flex flex-col mb-2 justify-center w-full">
                                        <div class="flex justify-center w-full mb-4">
                                            <x-form.input label="Choose file" name="file" classes="mb-2 md:mb-0 w-full" type="file" />
                                        </div>
                                        <div class="flex justify-center w-full">
                                            <button class="bg-blue-400 hover:bg-blue-500 text-white px-8 rounded text-sm py-2 mx-auto">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @else
                            @yield('manual_entry')
                        @endif
                    @endif
                @else
                    <div class="px-4">
                        <div class="pb-2 text-lg border-b">
                            Which subject you wish to add marks to?
                        </div>
                        <div class="flex flex-col pt-2 space-y-2">
                            @foreach ($subjects as $subject)
                            <a href="{{route('marks.create',['class'=>$subject->class_subject->class->id, 'exam'=>$exam->id])}}" class="hover:underline hover:text-blue-500">{{ucfirst($subject->class_subject->level_subject->subject->name.' - '.$subject->class_subject->class->grade->name.' '.$subject->class_subject->class->stream->name)}}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                @inject('exam', 'App\Models\Exam')
                <div>
                    <div  class="px-4 py-4 border-b bg-white text-xl">Choose Exam</div>
                    <div class="w-full text-gray-400">
                        @inject('Year', 'App\Models\AcademicYear')
                        @foreach ($exam->where('academic_year', $class?$class->academic_year_id:$Year->first()->id)->get() as $exam)
                        <a title="Click" href="{{route('marks.create',['class'=>$class?$class->id:null, 'exam'=>$exam->id])}}" class="block py-2 px-4 hover:bg-gray-100">{{ucfirst($exam->name)}}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
