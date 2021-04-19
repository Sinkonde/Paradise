@include('app.resource.class.parts.academic.results.mkeka')
@include('app.resource.class.parts.academic.results.summary')
@include('app.resource.class.parts.academic.results.top10')
@section('results')
@inject('teachers', 'App\Models\Teacher')
<div class="w-100 flex justify-center">
    <div class="w-full flex flex-col bg-white">
        <div class="w-full flex justify-between items-center pb-4 pt-3 sticky top-13 border-b mb-4 bg-white z-0">
            @if ($exam)
            <div class="flex w-full justify-between">
                <div class="">
                    <p class="text-lg text-gray-600">{{title('Matokeo ya '.$exam->exam->name)}}</p>
                </div>

                <div class="flex text-xs">
                    @foreach ([['name'=>'Mkeka', 'part'=>'mkeka'],['name'=>'Top10', 'part'=>'top_10'],['name'=>'Summary', 'part'=>'summary']] as $item)
                        <a href="{{url()->full().'&part='.$item['part']}}" class="py-1 pl-2 @if(request()->part == $item['part']) font-semibold underline text-yellow-500 @endif">{{$item['name']}}</a>
                    @endforeach

                    @if (is_connected())
                        <a href="{{route('mail.send_results_to_all', ['class'=>$class->id, 'exam'=>$exam->exam->id])}}" class="hover:bg-teal-100 bg-teal-50 text-teal-500 text-xs px-3 py-1 ml-4 rounded-full">Notify Parents</a>
                    @endif
                </div>
            </div>
            @else
            <p>All Results</p>
            @endif
        </div>

    @switch(request()->part)
        @case('summary')
            @yield('summary')
            @break
        @case('top_10')
            @yield('top10')
            @break
        @default
            @yield('mkeka')
    @endswitch
    </div>
</div>

@if (!$exam)
<div class="fixed right-4 bottom-4 flex">
    <a class="mr-2"  href="{{route('result.template',['class' => $class->id])}}">
        <x-form.button color='blue' label='Download Template' />
    </a>
    <a  href="{{route('marks.create',['class' => $class->id])}}">
        <x-form.button color='yellow' label='New' />
    </a>
</div>
@endif
@endsection
