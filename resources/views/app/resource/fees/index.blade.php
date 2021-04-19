@extends('index')
@section('contents')


    @foreach ($fees as $fee)

        @if ($loop->iteration%2 == 1 or $loop->index == 0)
            <div class="md:flex w-full mt-4">
        @endif
            <div class="w-full md:w-1/2 mb-4 md:mb-0 @if($loop->iteration%2 == 1) md:pr-2 @else md:pl-2 @endif">
                <x-fee.fee :fee="$fee" />
            </div>

        @if ($loop->iteration%2 == 0)
            </div>
        @endif

    @endforeach

<a class="fixed right-5 bottom-5" href="{{route('fees.create', ['fees_category'=>request()->fees_category, 'year'=>request()->year])}}">
    <x-form.button color='yellow' label='New' />
</a>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-light"><span class="font-semibold">{{$title->name}} </span>Plans ({{__('2021')}})</p>
@endsection
