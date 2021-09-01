@section('awards')
@if ($class->grade->grade == 7)
    <div class="flex flex-col w-full md:flex-row">

    </div>

    <a class="fixed bottom-5 right-5 focus:outline-none" title="Download Remedial collectio template" class="mr-2" href="{{route('remedial.template',$class->id)}}">
        <button class="focus:outline-none py-2 px-4 bg-blue-400 hover:bg-blue-500 text-white rounded-full ring-4">
            <span class="fi fi-star"></span> Create
        </button>
    </a>
@else
    <p class="text-4xl text-gray-200 mb-4">Not Allowed!</p>
    <p>Redirecting to home...</p>
    <p class="text-xs"> If you are not automatically redirected to home, please <a class="underline text-blue-500" href="{{request()->url()}}">Click here</a></p>
@endif

@endsection
