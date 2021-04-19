@include('app.resource.class.parts.academic.subjects')
@include('app.resource.class.parts.academic.results')
@section('academic')
<div class="flex -mt-4 bg-white shadow p-4">
    <div class="w-full md:w-10/12 pr-8">
        @switch($academic_link)
            @case('res')
                @yield('results')
                @break
            @case('sub')
                @yield('subjects')
                @break
            @default
                @yield('subjects')
                @break
        @endswitch
    </div>

    <div class="hidden md:flex flex-col w-2/12">
        @foreach ($academic_links as $link)
            <a href="{{route('classes.show',['class' => $class->id, 'academic' => $link['page'], 'link'=>'a'])}}"
                class="mb-2 py-1 text-center border text-xs rounded-full @if($link['page'] == $academic_link) bg-blue-50 border-blue-400 text-blue-600 @endif">{{$link['name']}}</a>
        @endforeach
    </div>
</div>
@endsection
