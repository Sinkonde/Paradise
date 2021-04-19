@section('bursar')
<div class="flex flex-col w-full md:flex-row">

</div>

<a class="fixed bottom-5 right-5 focus:outline-none" title="Download Remedial collectio template" class="mr-2" href="{{route('remedial.template',$class->id)}}">
    <button class="focus:outline-none py-2 px-4 bg-blue-400 hover:bg-blue-500 text-white rounded-full ring-4">
        <span class="fi fi-download"></span> Remedial Collection Template
    </button>
</a>
@endsection
