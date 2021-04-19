@section('top10')
<div class="w-full hidden md:flex text-sm">
    @if (count($results))
    <table style="width:100%; border-collapse:collapse; font-size:16px">
        <thead>
            <tr class="bg-gray-100">
                <th class="border" style="padding:5px; border:1px solid black">Position</th>
                <th class="border text-left" style="padding:5px; border:1px solid black; text-align:left">Name</th>
            </tr>
        </thead>
        <tbody>
            @inject('members', 'App\Models\ClassMember')
            @foreach (array_reverse(array_slice($results['results'],0,10)) as $student => $result)
            <tr>
                <td style="text-align:center; border:1px solid black; padding:5px">
                    @if ($loop->last)
                        <i style="padding:2px 6px; background-color:#e4e5e7">Best Student</i>
                    @else
                    {{count(array_slice($results['results'],0,10)) - $loop->index}}
                    @endif
                    </td>
                @php
                    $st = $members->find($student)->student->particulars
                @endphp
                <td  style="text-align:left; border:1px solid black; padding:5px">
                    <div class="w-full flex items-center" style="display:flex">
                        {{ucwords($st->first_name.' '.$st->second_name.' '.$st->sur_name)}}

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
