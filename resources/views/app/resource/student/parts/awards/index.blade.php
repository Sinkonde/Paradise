@section('awards')
<div class="flex justify-between w-full rounded">
    <div class="md:w-3/12 bg-white rounded  shadow">
        <div class="font-semibold w-full p-2 border-b">Academic Award Cerificates</div>
        <div class="divide-y py-4 px-2 text-base">
            <table class="w-full">
                @foreach ($student->particulars->awards as $award)
                <tr>
                    <td>{{$loop->iteration}}. </td>
                    <td>
                        <a href="#" class="hover:underline text-gray-600">{{ucfirst($award->academic_awards_year->award_title->name)}}</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
</div>
@endsection
