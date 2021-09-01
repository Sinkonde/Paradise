@extends('index')
@section('contents')
    <div class="w-100 flex justify-center" x-data={showModal:false}>
        <div class="w-full flex flex-col py-4 md:bg-white md:shadow md:rounded">

            <div class="w-full md:px-4">
                @if (count($award_titles) == 0)
                    <p class="text-xl font-semibold text-gray-400">No any Academic Award Title set! <a class="text-blue-400 hover:text-blue-500 hover:underline" href="{{route('award-titles.create',['callback' => route('award-titles.index')])}}">Create</a> now</p>
                @else
                <table class="w-full text-sm  hidden md:table">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">SN</th>
                            <th class="pb-4 text-left">Name</th>
                            <td></td>
                            <th class="pb-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($award_titles as $title)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 text-center">{{$loop->iteration}}</td>
                                <td class="py-2">
                                    <a href="{{route('award-titles.show',$title->id)}}" class="hover:underline hover:text-blue-800">
                                        {{ucwords(strtolower($title->name))}}
                                    </a>
                                </td>
                                <td>
                                    @if ($title->academic_award_year($academic_award_id)->first())
                                        <button class="bg-green-100 text-green-500 hover:bg-green-200 text-xs px-2 rounded-full" @click="showModal=true" onclick="addTitleToWinnerForm('Select {{date('Y')}} {{$title->name}} Winners', '{{$title->academic_award_year($academic_award_id)->first()->id}}')">Add {{date('Y')}} Winners</button>
                                    @else
                                        <form action="{{route('academic-award-years.store')}}" method="post">
                                            @csrf
                                            <input hidden name="academic_award_id" value="{{$academic_award_id}}" />
                                            <input hidden name="award_title_id" value="{{$title->id}}" />
                                            <button class="cursor-pointer hover:bg-green-200 text-gray-500 hover:text-gray-600 bg-gray-100 rounded-full text-xs px-2 mr-2" role="button">Add to this year</button>
                                        </form>
                                    @endif
                                </td>
                                <td class="py-2 flex flex-row">
                                    <a href="{{route('award-titles.edit',$title->id)}}" class="mr-4 cursor-pointer hover:underline text-blue-500 hover:text-blue-600" role="button">Edit</a>

                                    <form action="{{route('award-titles.destroy', $title->id)}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <button class="cursor-pointer hover:underline text-red-500 hover:text-red-600" role="button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    @foreach ($award_titles as $title)
                    <div class="md:hidden p-3 bg-white rounded shadow my-2">
                        <div>
                            <p class="font-normal">
                                <a href="{{route('users.show',$title->id)}}" class="hover:underline text-blue-500">
                                    {{ucwords(strtolower($title->name))}}
                                </a>
                            </p>
                        </div>
                        <div class="justify-start items-stretch">
                            <form action="{{route('titles.destroy', $title->id)}}" method="post">
                                @csrf
                                {{method_field('delete')}}
                                <button class="text-sm cursor-pointer hover:underline text-red-500 hover:text-red-500" role="button">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Modal --}}
        <div class="fixed left-0 top-0 w-full h-full bg-black bg-opacity-100 flex justify-center items-center" style="z-index:999999999999;" x-show="showModal" x-on:keydown.escape="showModal=false">
            <div class="w-10/12 h-10/12 rounded text-gray-500 overflow-y-auto" id="members">
                <p class="text-right text-2xl text-red-400 hover:text-red-500 cursor-pointer" @click="showModal=false">X</p>
                <div class="flex justify-between my-4">
                    <p class="text-2xl text-gray-200" id="addTitleToWinnerFormTitle"></p>
                    <button class="border border-gray-500 hover:border-gray-300 hover:text-gray-300 text-2xl px-4 rounded" onclick="document.getElementById('awardWinnersForm').submit()">OK</button>
                </div>
                @if (count($members))
                <p class="mt-4"><input onChange="selectAll()" type="checkbox" id="selectAllCheckbox" /> <span id="selectAllText">Select All</span></p>
                    <form action="{{route('academic-award-winners.store')}}" method="post" id="awardWinnersForm">
                        @csrf
                        <input type="hidden" name="academic_award_id" id="academicAwardYearId" />
                        <input type="hidden" name="_many" value="many" />
                        <table class="w-full mt-4">
                            @foreach ($members as $member)
                            @if ($loop->iteration%5==0 or $loop->index == 0)
                                <tr>
                            @endif

                            @if ($loop->iteration%5!=0)
                                <td><input class="bg-gray-500" type="checkbox" name="winners[]" value="{{$member->id}}" /> {{title($member->first_name.' '.$member->sur_name)}}</td>
                            @endif

                            @if ($loop->iteration%5==0)
                                </tr>
                            @endif
                        @endforeach
                        </table>
                    </form>
                @else
                No any members so far!!
                @endif
            </div>
        </div>
        {{-- End Modal --}}
    </div>

    <a href="{{route('award-titles.create',['callback' => route('award-titles.index')])}}" class="absolute bottom-4 right-4">
        <button class="rounded-full p-4 md:p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>

    <script>
        function addTitleToWinnerForm(title, academicYearId){
            document.getElementById('addTitleToWinnerFormTitle').innerHTML = title;
            document.getElementById('academicAwardYearId').value = academicYearId;
        }

        function selectAll(){
            var container = document.getElementById('members');//
            console.log(document.getElementById('selectAllCheckbox').checked)
            if (document.getElementById('selectAllCheckbox').checked) {
                container.getElementsByTagName('input[type="checkbox"]').checked;
            }
        }
    </script>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-thin">Academic Award Titles</p>
@endsection
