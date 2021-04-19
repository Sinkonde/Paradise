<div class="w-full flex flex-col py-4 bg-white shadow rounded">
    <div class="w-full flex justify-between items-center px-4 pb-4 md:px-4 md:pb-4 md:mb-4 border-b">
        <input class="w-full py-1 px-4 text-sm bg-gray-50 border border-gray-200 focus:bg-white rounded " wire:model="searchUser" placeholder="Search User" />
    </div>

    <div class="w-full px-4 md:flex flex-col">
        @if (count($users) == 0)
            <p class="bg-orange-200 text-orange-600 text-lg font-thin rounded py-2 px-5 w-full">Nothin found! <a class="text-orange-800 hover:underline" href="{{route('workers.create',['callback' => route('teachers.index')])}}">Add</a> now</p>
        @else
        <table class="w-full text-sm">
            <thead>
                <tr class=" border-b border-gray-100">
                    <th class="pb-4">SN</th>
                    <th class="pb-4 text-left">Name</th>
                    <th class="pb-4 text-left">Email</th>
                    <th class="pb-4 text-left hidden"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-1 text-center">{{($users->currentPage() - 1) * $users->perPage() + $loop->iteration}}</td>
                        <td class="py-1">
                            <a href="{{route('users.show', $user->id)}}" class="hover:underline hover:text-blue-800">
                            {{$user->gender == 'm' ? 'Mr. ' : "Ms. "}}
                            {{ucwords(strtolower($user->first_name.' '.$user->second_name.' '.$user->sur_name))}}
                            </a>
                        </td>
                        <td class="py-1 text-left">{{$user->email}}</td>
                        <td class="py-1 flex-row hidden">
                            <div class="flex">
                                <a href="#" class="text-blue-500 hover:underline">Edit</a>
                            </div>
                            {{-- <form action="{{route('users.destroy', $user->id)}}" method="post">
                                @csrf
                                {{method_field('delete')}}
                                <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Remove</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5 px-2 rounded pt-3 border-gray-50 border-t">
            {{$users->links()}}
        </div>
        @endif
    </div>
</div>
