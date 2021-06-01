@include('app.resource.class.parts.academic.subjects')
@include('app.resource.class.parts.academic.results')
@section('academic')
@php
    switch($academic_link){
        case 'res':
            $title = "Results";
            break;
        case 'sub':
            $title = "Subjects";
            break;
        default:
            $title = "Subjects";
            break;
    }
@endphp
<div class="flex -mt-4 bg-white shadow p-4">
    <div class="w-full md:w-10/12 pr-8">
        {{-- <div class="w-full flex justify-between items-center p-4 border-b border-gray-200 mb-4">
            <div>
                <p class="md:text-lg md:text-gray-600 md:font-thin">{{$title}} <span>({{$subjects->count()}} Subjects)</span></p>
                <a class="absolute right-4 bottom-4" href="{{route('class-subjects.create',['level' => $class->grade->level->id, 'class'=>$class->id, 'callback' => route('classes.show', ['class'=>$class->id, 'link'=>'a'])])}}">
                    <x-form.button color='yellow' label='New' />
                </a>
            </div>
            <div class="md:hidden flex flex-col" x-data={showLeftPane:false}>
                <span class="fi fi-angle-down" @click="showLeftPane=true"></span>
                <div x-show="showLeftPane" @click.away="showLeftPane=false">
                    <div class="flex flex-col w-2/12 absolute right-3 border-t bg-white p-2 rounded shadow-lg">
                        @foreach ($academic_links as $link)
                            <a href="{{route('classes.show',['class' => $class->id, 'academic' => $link['page'], 'link'=>'a'])}}"
                                class="mb-2 py-1 text-center text-xs @if($link['page'] == $academic_link) text-blue-600 @endif">{{$link['name']}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}
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
