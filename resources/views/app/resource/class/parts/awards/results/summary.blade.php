@inject('subject', 'App\Models\SubjectTeacher')
@php
    $labels = ['A', 'B', 'C', 'D', 'E'];
    //dd($results['sub_summary']);
@endphp
@section('summary')
@if (isset($results['sub_summary']))

<div class="w-full">
    @foreach ($results['sub_summary'] as $sub => $summary)
    {{-- {{dd($summary)}} --}}
        <p class="text-sm font-medium"><b>{{title($subject->find($sub)->class_subject->level_subject->subject->name)}}</b></p>
        <table class="w-full text-center text-xs mb-6">
            <tr>
                <td colspan="3" class="border py-0">Sat for Exam</td>
                @foreach ($labels as $label)
                    <td colspan="3" class="border py-0">{{$label}}</td>
                @endforeach
            </tr>
            <tr>
                <td class="border py-0">Boys</td>
                <td class="border py-0">Girls</td>
                <td class="border py-0">Total</td>
                @foreach ($labels as $label)
                    <td class="border py-0">Boys</td>
                    <td class="border py-0">Girls</td>
                    <td class="border py-0">Total</td>
                @endforeach
            </tr>
            <tr>
                @php
                    $b =[]; $g = [];
                    foreach($labels as $l){
                        if (isset($summary[$l])) {
                            if (isset($summary[$l]['m'])) {
                               array_push($b, count($summary[$l]['m']));
                            }
                            if (isset($summary[$l]['f'])) {
                               array_push($g, count($summary[$l]['f']));
                            }
                        }
                    }
                @endphp
                <td class="border py-0">{{array_sum($b)}}</td>
                <td class="border py-0">{{array_sum($g)}}</td>
                <td class="border py-0">{{array_sum($b) + array_sum($g)}}</td>
                @foreach ($labels as $label)
                @php
                    $boys = 0; $girls = 0;
                @endphp
                    <td class="border py-0">
                        @if (isset($summary[$label]) and isset($summary[$label]['m']))
                            {{count($summary[$label]['m'])}}
                            @php
                                $boys = count($summary[$label]['m'])
                            @endphp
                        @else
                        0
                        @endif
                    </td>
                    <td class="border py-0">
                        @if (isset($summary[$label]) and isset($summary[$label]['f']))
                            {{count($summary[$label]['f'])}}
                            @php
                                $girls = count($summary[$label]['f'])
                            @endphp
                        @else
                        0
                        @endif
                    </td>
                    <td class="border py-0">{{$boys + $girls}}</td>
                @endforeach
            </tr>
        </table>
    @endforeach
</div>
@endif
@endsection
