@section('top10')
<div class="w-full hidden md:flex text-sm">
    @if (count($results))
    <table class="w-full text-xs">
        <thead>
            <tr class="bg-gray-100">
                <th class="border">Position</th>
                <th class="border text-left">Name</th>
            </tr>
        </thead>
        <tbody>
            @inject('members', 'App\Models\ClassMember')
            @foreach (array_reverse(array_slice($results['results'],0,10)) as $student => $result)
            <tr class="hover:bg-gray-50">
                <td class="py-1 text-center border">{{count(array_slice($results['results'],0,10)) - $loop->index}}</td>
                @php
                    $st = $members->find($student)->student->particulars
                @endphp
                <td class="border py-1 px-2">
                    <div class="w-full flex items-center">
                        {{ucwords($st->first_name.' '.$st->second_name.' '.$st->sur_name)}}
                        @if ($loop->last)
                            <div class="ml-4 rounded-full py-1 px-3 text-xs bg-green-100 text-green-700">Best Student</div>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
