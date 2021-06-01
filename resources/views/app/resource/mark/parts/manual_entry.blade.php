
@section('manual_entry')
@if ($teacher)
    <div class="w-full bg-white rounded">
        @if ($members)
            <livewire:marks.mark-manually />
        @endif
    </div>
@endif
@endsection

@section('title')
@if (request()->class)
@if ($teacher)
<p class="text-lg text-gray-600 font-thin">Add or edit marks for class
<b><a class="hover:text-blue-600" href="{{route('classes.show',['class'=>request()->class, 'link'=>'m'])}}">{{$class->grade->name.' '.$class->stream->name}}</a></b>
<span class="text-medium text-gray-400 font-thin bg-gray-50 rounded px-2">
    {{ucfirst($exam->name)}}
</span>
</p>
@endif
@endif
@endsection

@section('navs')
@if ($teacher)
@if (request()->class)
    <a href="{{route('classes.show',['class'=>request()->class, 'academic'=>'res', 'link'=>'a', 'exam'=>$exam->id])}}">
        <button class="text-white bg-blue-500 hover:bg-blue-600 rounded py-1 px-3 text-xs">
            Done
        </button>
    </a>
@endif
@endif
@endsection
