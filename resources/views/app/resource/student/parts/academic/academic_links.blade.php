@section('academic_links')
<div class="w-full py-4 px-4 flex flex-col">
    @foreach ($academic_links as $link)
        <a href="{{route('students.show',['student'=>$student->id,'link'=>'a', 'academic'=>$link])}}" class="text-sm w-full py-1 px-4 hover:border-blue-500 bg-gray-100 mb-2 border border-gray-500 rounded-full @if($academic_active == $link)bg-blue-100 @endif">{{$link}}</a>
    @endforeach
</div>
@endsection
