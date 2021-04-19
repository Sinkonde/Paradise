@section('timelines')
<div class="flex justify-between">
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-1 text-center">Date</th>
                <th class="px-2 py-1 text-left">Descriptions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->timelines()->orderBy('date', 'desc')->get() as $timeline)
                <tr class="hover:bg-gray-100">
                    <td class="px-2 py-1 text-center">{{date('jS, M y', strtotime($timeline->date))}}</td>
                    <td class="px-2 py-1 text-left">{{$timeline->description}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
