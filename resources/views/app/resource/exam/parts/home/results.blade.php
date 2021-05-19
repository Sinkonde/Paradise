@section('results')
<div class="w-full bg-white rounded-lg divide-y  border font-thin px-4">
    <div class="w-full flex justify-between py-4 items-center">
        <p class="text-lg mb-1 font-semibold">Results</p>
        <a href="{{route('marks.create', ['exam'=>$exam->id, 'callback'=>route('exams.show',$exam->id)])}}" class="text-xs text-blue-500 hover:underline">Add</a>
    </div>


    <table class="w-full">
        <thead>
            <tr class="text-gray-700">
                <th class="text-left py-2">Class</th>
                <th class="text-left py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tbody class="divide-y divide-gray-100">
                @foreach ($exam->class_results as $class)
                <tr class="hover:bg-gray-50">
                    <td class="w-3/4">
                        <a class="hover:text-blue-500 hover:underline" href="{{route('classes.show', $class->class->id)}}">Class {{ucfirst($class->class->grade->name).' '.strtoupper($class->class->stream->name)}}</a>
                    </td>
                    <td>
                        <div class="flex">
                            <a class="pr-4 hover:text-blue-500 hover:underline" href="{{route('classes.show', ['class'=>$class->class->id, 'exam'=>$class->id, 'academic'=>'res', 'link'=>'a'])}}">View &#X1F441</a>
                            <a target="_blank" class="hover:text-blue-500 hover:underline" href="{{route('mkeka-pdf', ['class'=>$class->class->id, 'class_result_id'=>$class->id, 'exam'=>$class->id,])}}">PDF &#x2197</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </tbody>
    </table>
</div>
@endsection
