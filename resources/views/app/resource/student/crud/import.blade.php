@extends('index')
@section('contents')
    <div class="w-100 flex justify-center">
        <div class="w-full md:w-1/2 py-4 bg-white shadow-lg rounded-lg">
            <div class="w-full block flex justify-center items-center mb-3 pb-3 border-b border-gray-200">
                <p class="text-xl text-gray-600 font-thin">
                    Import Students for class
                    <b><a class="hover:text-blue-600" href="{{route('classes.show',['class'=>$class->id, 'link'=>'m'])}}">{{$class->grade->name.' '.$class->stream->name}}</a></b>
                </p>
            </div>


            <div class="w-full block flex justify-between items-center">
                <div class="w-full flex justify-center flex-col">
                    <form action="{{route('students.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$callback}}" name="callback" />
                        <input type="hidden" value="_import" name="_import" />
                        <input type="hidden" value="{{$class->id}}" name="class_id" />
                        <div class="student-info p-4 flex flex-col mb-2 justify-center w-full">
                            <div class="flex justify-center w-full mb-4">
                                <x-form.input label="Choose file" name="file" classes="mb-2 md:mb-0 w-full" type="file" />
                            </div>
                            <div class="flex justify-center w-full">
                                <button class="bg-blue-400 hover:bg-blue-500 text-white px-8 rounded text-sm py-2 mx-auto">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
