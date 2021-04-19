<div class="w-full rounded shadow-md bg-white hover:shadow-2xl">
    <div class="w-full border-b p-4 flex justify-between">
        <div class="font-semibold">{{ucfirst($fee->name)}}</div>
        <div class="flex items-center">
            <a href="{{route('fees.edit', ['fee'=>$fee->id])}}"><button class="text-xs text-blue-600 hover:bg-blue-100 px-2 py-1 rounded" title="Edit">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>
            </a>
            @if ($fee->fee_structure->count() == 0)
            <span >
                <div class="font-semibold cursor-pointer text-lg text-red-600 hover:bg-red-100 px-2 py-0 rounded" title="Delete this" onclick="document.getElementById('{{$fee->id}}').submit()">&times;</div>
            </span>
            @endif

        </div>

    </div>
    <div class="p-4 w-full">
        @if ($fee->description or $fee->fee_structure->count() > 0)
        <div class="w-full rounded border-l-8 border-teal-600 text-teal-600 bg-teal-50 py-2 px-3 mb-5 flex justify-between text-xs">
            <div class="flex items-center">
                <div class="text-4xl pr-4 flex items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex flex-col">
                    @if ($fee->description)
                    <p class="text-teal-400"><b>Description</b></p>
                    <p class="">{{$fee->description}}</p>
                    @else
                    <p class="text-teal-400"><b>Total amount</b></p>
                    @endif
                </div>
            </div>
            <div class="flex items-center text-lg font-semibold text-teal-400" title="Total amount per year">
                {{number_format($fee->fee_structure->sum('amount'))}}
            </div>
        </div>
        @endif
        <div class="w-full">
            <div class="w-full flex justify-between">
                @if ($fee->fee_structure->count() > 0)
                <p class="text-lg font-light pb-2">Installment Plans</p>
                <a href="{{route('fees-structures.create',['fee'=>$fee->id])}}" title="Add Plan" class="text-xs py-1 px-2 rounded hover:text-green-900 text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </a>
                @else
                <a href="{{route('fees-structures.create',['fee'=>$fee->id])}}" title="Add Plan">
                    <p class="text-lg font-light pb-2 hover:underline hover:text-blue-700">Add Plan</p>
                </a>
                @endif


            </div>

        @if ($fee->fee_structure->count() > 0)
            <div class="w-full rounded divide-y flex flex-col border text-xs">
                <div class="w-full flex divide-x bg-gray-100 text-gray-600">
                    <div class="w-1/2 p-1"><b>Period</b></div>
                    <div class="w-1/2 p-1"><b>Amount</b></div>
                </div>
                @foreach ($fee->fee_structure as $structure)
                <div class="w-full flex divide-x">
                    <div class="w-1/2 p-1">{{date('M Y', strtotime($structure->from))}} - {{date('M Y', strtotime($structure->to))}}</div>
                    <div class="w-1/2 p-1 flex justify-between">
                        <p>{{number_format($structure->amount)}}</p>
                        <a href="{{route('fees-structures.edit', $structure->id)}}"><button class="text-xs text-blue-600 hover:bg-blue-100 px-2 py-1 rounded" title="Edit This">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
         @endif

        </div>
    </div>
</div>

<form action="{{route('fees.destroy', $fee->id)}}" method="post" id="{{$fee->id}}">
    @csrf
    {{method_field('delete')}}
</form>
