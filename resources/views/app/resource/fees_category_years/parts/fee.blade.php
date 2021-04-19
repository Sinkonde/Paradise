@section('fee')
    <div class="w-full rounded shadow-md bg-white">
        <div class="w-full border-b p-4 flex justify-between">
            <div class="font-semibold">Title</div>
            <div class="font-semibold text-red-500 hover:text-red-600 text-lg" title="Delete this">&times;</div>
        </div>
        <div class="p-4 w-full">
            <div class="w-full border border-l-8 border-green-600 text-green-600 bg-green-50 py-2 px-3 mb-5">
                <span class="fi fi-exclamation"></span> Description
            </div>
            <div class="w-full">
                <div class="w-full flex justify-between">
                    <p class="text-lg font-light pb-2">Installment arrangements</p>
                    <span class="fi fi-pencil"></span>
                </div>
                <div class="w-full rounded-md divide-y flex flex-col border">
                    <div class="w-full flex divide-x">
                        <div class="w-1/2 p-2"><b>Period</b></div>
                        <div class="w-1/2 p-2"><b>Amount</b></div>
                    </div>
                    <div class="w-full flex divide-x">
                        <div class="w-1/2 p-2">Jan - June</div>
                        <div class="w-1/2 p-2">300,000</div>
                    </div>
                </div>
            </div>
            <div class="w-full text-left flex flex-row-reverse pt-8 items-center bg text-sm">
                <a href="#" class="bg-blue-500 hover:bg-blue-600 py-1 px-4 rounded text-white">Edit</a>
            </div>
        </div>
    </div>
@endsection