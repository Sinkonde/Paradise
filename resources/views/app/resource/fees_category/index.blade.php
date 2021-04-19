@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            <a class="absolute right-5 bottom-5" href="{{route('fees-categories.create')}}">
                <x-form.button color='yellow' label='New' />
            </a>

            <div class="w-full px-4 hidden md:flex">
                @if (count($fees_categories) == 0)
                    <p class="text-xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr class=" border-b border-gray-200">
                            <th class="pb-2">SN</th>
                            <th class="pb-2 text-left">Name</th>
                            <th class="pb-2 text-center">This Year</th>
                            <th class="pb-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($fees_categories as $fees_category)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 text-center">{{$loop->iteration}}.</td>
                                <td class="py-3">
                                    <a href="{{route('fees-categories.show', $fees_category->id)}}" class="text-medium hover:undeline hover:text-blue-800 hover:underline">{{$fees_category->name}}</a>
                                    <p class="text-gray-400 text-sm">{{$fees_category->description}}</p></td>
                                <td class="pb-2 text-left">
                                    <div class="flex justify-center">
                                        @if ($fees_category->find_fees_category_year($academic_year->id)->first())
                                        <a title="Click to view status" href="{{route('fees.index',['fees_category'=>$fees_category->id, 'year' => $academic_year->id])}}" class="text-yellow-600 hover:text-yellow-700 text-sm rounded-full font-normal bg-yellow-100 hover:bg-yellow-200 hover:shadow-sm px-3">In use</a>
                                        @else
                                        <form action="{{route('fees-category-years.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="fees_category_id" value="{{$fees_category->id}}" />
                                            <input type="hidden" name="academic_year_id" value="{{$academic_year->id}}" />
                                            <button class="cursor-pointer px-4 text-xs rounded bg-blue-100 hover:bg-blue-200 text-blue-700 " role="button" title="Use in this year">Set</button>
                                        </form>
                                    @endif
                                    </div>
                                </td>
                                <td class="py-3 flex flex-row text-xs">
                                    <div class="h-full flex items-center">
                                        <a class="mr-4 text-blue-400 hover:underline hover:text-blue-600" href="{{route('fees-categories.edit', $fees_category->id)}}">Edit</a>
                                        <form action="{{route('fees-categories.destroy', $fees_category->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('title')
<p class="text-lg text-gray-600 font-thin">Fees Categories</p>
@endsection

@section('navs')
    <a href="{{route('fees-category-years.index')}}" class="mr-4 hover:text-blue-800 hover:font-semibold">Years</a>
    <a href="{{route('fees-categories.index')}}" class="mr-4 hover:text-blue-800 hover:font-semibold">Fees Categories</a>
@endsection
