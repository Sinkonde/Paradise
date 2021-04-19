@section('linker')
@php
    $links = [
        'Classes' => ['link' => 'classes.index'],
        'Reports' => ['link' => 'student-reports.index'],
    ];
@endphp
<div class="w-full flex justify-around">
    @foreach ($links as $l =>$link)
        <a href="{{route($link['link'])}}" class="my-2 p-2 px-20 rounded hover:shadow-lg hover:underline hover:text-blue-500 bg-blue-50">{{$l}}</a>
    @endforeach
</div>
@endsection
