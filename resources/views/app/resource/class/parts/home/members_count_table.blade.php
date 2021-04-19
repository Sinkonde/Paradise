@section('members_count_table')
    <div class="w-full rounded shadow divide-y bg-white text-xs">

    <div class="flex w-full">
        <div class="w-4/4 flex items-center justify-center p-5 text-lg">
            {{request()->path() == 'home'? "Other students count":"All Class member count"}}
        </div>
    </div>

    <div class="flex w-full divide-x">
        <div class="w-1/4 flex items-center justify-center p-2"></div>
        <div class="w-1/4 flex items-center justify-center p-2">Boys</div>
        <div class="w-1/4 flex items-center justify-center p-2">Girls</div>
        <div class="w-1/4 flex items-center justify-center p-2">Total</div>
    </div>

    @if (request()->path() == 'classes')
        <div class="flex w-full divide-x">
            <div class="w-1/4 flex items-center justify-center p-2">Registered</div>
            <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['registered']['B']}}</div>
            <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['registered']['G']}}</div>
            <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['registered']['B'] + $members_count['registered']['G']}}</div>
        </div>
    @endif

    <div class="flex w-full divide-x">
        <div class="w-1/4 flex items-center justify-center p-2">Boarding</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['boarders']['B']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['boarders']['G']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['boarders']['B'] + $members_count['boarders']['G']}}</div>
    </div>

    <div class="flex w-full divide-x">
        <div class="w-1/4 flex items-center justify-center p-2">Dayscholar</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['dayscholar']['B']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['dayscholar']['G']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['dayscholar']['B'] + $members_count['dayscholar']['G']}}</div>
    </div>

    <div class="flex w-full divide-x">
        <div class="w-1/4 flex items-center justify-center p-2">Reported</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['reported']['B']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['reported']['G']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['reported']['B'] + $members_count['reported']['G']}}</div>
    </div>

    <div class="flex w-full divide-x">
        <div class="w-1/4 flex items-center justify-center p-2">At Vacation</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['at_vacation']['B']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['at_vacation']['G']}}</div>
        <div class="w-1/4 flex items-center justify-center p-2">{{$members_count['at_vacation']['B'] + $members_count['at_vacation']['G']}}</div>
    </div>
</div>
@endsection
