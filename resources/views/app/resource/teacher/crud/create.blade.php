@extends('index')
@section('contents')
    <div class="w-100 flex justify-center items-center">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            @if (!$workers->count())
            <div class="w-full flex justify-between items-center px-4 md:px-4 rounded">
                <p class="md:text-lg text-yellow-600 font-thin"><span class="fi fi-exclamation"></span> You have to <a class="text-blue-600 hover:underline" href="{{route('workers.create')}}">register workers</a> first before make them teachers!</p>
            </div>
            @else
                <div class="w-full flex justify-between items-center px-4 pb-4 mb-4 md:px-4 md:pb-4 md:mb-4 border-b">
                    <p class="text-xl md:text-xl text-gray-600 font-thin">Set Teachers</p>
                </div>

                <div class="w-full px-4 md:px-4 flex flex-col">
                    <form action="{{route('teachers.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="callback" value="{{$callback ? $callback : NULL}}"/>
                        <table class="w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="py-2">Select</th>
                                    <th class="py-2 text-left">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workers as $worker)
                                @if (!in_array($worker->id, $avail_teachers))
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 flex justify-center">
                                        <input type="checkbox" name="workers[]" value="{{$worker->id}}" />
                                    </td>

                                    <td class="py-2">
                                        {{$worker->guardian->particulars->gender == 'm' ? 'Mr. ' : "Madam "}}
                                        {{ucwords(strtolower($worker->guardian->particulars->first_name.' '.$worker->guardian->particulars->second_name.' '.$worker->guardian->particulars->sur_name))}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td class="pt-4">
                                        <button class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded">Done!</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            @endif

        </div>
    </div>
@endsection
